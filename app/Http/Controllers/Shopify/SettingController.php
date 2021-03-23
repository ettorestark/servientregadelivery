<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vexsolutions\Helpers\Dates;
use App\Vexsolutions\Helpers\UStore;
use App\Models\EMMetadata;
use App\Models\Store;
use App\Models\Hour;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Location;
use App\Models\Country;
use App\Models\Holiday;
use App\Models\OrderStatus;
use App\Models\Productmetadata;
use App\Http\Controllers\Servientrega\ServientregaCotizadorController;
use App\Http\Controllers\Soap\SoapController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Log;

class SettingController extends Controller
{
    /**
     *
     * @return View
     */
    public function Index(Request $request)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

        $settings = Setting::findByStoreId($shopApi->id);
        if (is_null($settings) || $settings->getServientregaApi() == null ||  $settings->getServientregaSecret() == null ) {
            $default_lang = UStore::DefLang($shopApi);
            if(is_null($settings)){
                $settings = new Setting();
            }
            $settings->setLanguage($default_lang);
            $pwdDesencriptada="";
        }
        else{
            //Init servientrega soap
            $servientregaSoap = new SoapController($settings->SETT_SERVER, "", "", "", "", false, $headers=false);
            $pwdDesencriptada = $servientregaSoap->desencriptar_contrasena($settings->SETT_SERVIENTREGA_SECRET)->DesencriptarContrasenaResult;
        }
        app('translator')->setLocale($settings->getLanguage());
        

        $languages = Language::all();
        $orderStatus  = OrderStatus::all()->where('enabled', 1);
        $workingHours = $this->adapterHours($settings->getId());
        $locations = $this->adapterStoreLocations($shop, $shopApi);
        $holidays = $this->adapterHollydays($settings->getId(), $shopApi->id );
        $months = Dates::getMonths();
        $doubleTurn = $this->hasDoubleTurn($workingHours);

        return view('shopify.settings', [
            "settings" => $settings,
            "months" => $months,    
            "languages" =>$languages,
            "workingHours" => $workingHours,
            "orderStatus" => $orderStatus,
            "locations" => $locations,
            "holidays" => $holidays,
            "doubleTurn" => $doubleTurn,
            "domain" => $domain,
            "pwdDesencriptada" => $pwdDesencriptada
        ]);
    }

    public function save(Request $request)
    {
        $shop = Auth::user();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        $domain = $shop->getDomain()->toNative();

        app('translator')->setLocale('es');
        $value = $request->validate([
            'SETT_FREE_FOR_DEFAULT' => 'nullable|numeric',
            'SETT_COST_DEFAULT' => 'nullable|numeric',
            'SETT_PERCENTAGE_DEFAULT' => 'nullable|numeric',
        ]);
        
        try {
            $data = $request->all();

            $postLocations  = isset($data['locations']) ? $data['locations'] : [];
            $workingdays    = ($data['days']);
            $holidays      = isset($data['holidays']) ? $data['holidays'] : [];
            
            $allowscheduled    = (isset($data['SETT_ALLOWSCHEDULED'])) ? 1 : 0;
            $allowfirstwidget  = (isset($data['SETT_ALLOWFIRSTWIDGET'])) ? 1 : 0;
            $allowsecondwidget = (isset($data['SETT_ALLOWSECONDWIDGET'])) ? 1 : 0;
            $createStatus   = $data['SETT_CREATE_STATUS'];


            $emstore = Store::findByStoreId($shopApi->id);

            if (is_null($emstore)) {
                $emstore = new Store();
            }

            $emstore->STORE_ID = $shopApi->id;
            $emstore->STORE_DOMAIN = $domain;
            $emstore->STORE_TIMEZONE = $shopApi['timezone'];
            $emstore->STORE_IANA_TIMEZONE = $shopApi['iana_timezone'];
            $emstore->save();

            if (!($settings = Setting::findByStoreId($shopApi->id))) {
                $settings = new Setting();
            }
            #Delete last image
            if(isset($data["image"]) ){
                $imageName = $this->imageUploadPost($request);
                $lastImage = $settings->getImage();
                if($lastImage != null && $imageName != false){
                    $image_path = public_path('uploads/'.$lastImage);
                    if( file_exists( $image_path ) ){
                        try{
                            unlink($image_path);
                        }
                        catch(Exception $e){}
                    }
                }
            }
            $currentMethodTitle = $settings->getMethodTitle();
            //Init servientrega soap
            $servientregaSoap = new SoapController($data['SETT_SERVER'], "", "", "", "", false, $headers=false);
            $pwdEncriptada = $servientregaSoap->encriptar_contrasena($data['SETT_SERVIENTREGA_SECRET'])->EncriptarContrasenaResult;
                    
            $settings->setStoreId($shopApi->id)
                    ->setStoreName($shopApi->name)
                    ->setLanguage($data['SETT_LANGUAGE'])
                    ->setEnable(1) //isset($data['SETT_ENABLE']) ? 1 : 0
                    ->setServer($data['SETT_SERVER'])
                    ->setServientregaApi($data['SETT_SERVIENTREGA_API'])
                    ->setServientregaSecret($pwdEncriptada)
                    ->setServientregaBillingCode($data['SETT_SERVIENTREGA_BILLING_CODE'])
                    ->setGoogleApiKey("")
                    ->setMethodTitle($data['SETT_METHOD_TITLE'])
                    ->setMethodDescription($data['SETT_METHOD_DESCRIPTION'])
                    ->setCostType($data['SETT_COST_TYPE'])
                    ->setCostDefault($data['SETT_COST_DEFAULT'])
                    ->setPercentageDefault($data['SETT_PERCENTAGE_DEFAULT'])
                    ->setFreeForDefault($data['SETT_FREE_FOR_DEFAULT'])
                    ->setImage( (isset($imageName) ) ? $imageName: $settings->getImage() ) 
                    ->setAllowScheduled($allowscheduled)
                    ->setAllowFirstWidget($allowfirstwidget)
                    ->setAllowSecondWidget($allowsecondwidget)
                    ->setCreateStatus($createStatus)
                    ->save();

            $this->saveLocations($settings->getId(), $shopApi->id, $postLocations);

            $this->saveHorarios($settings->getId(), $shopApi->id, $workingdays);

            $this->saveHollydays($settings->getId(), $shopApi->id, $holidays);

            $carrier = $this->createCarrierService($settings, $currentMethodTitle);
            if ( $carrier ) {
                $emstore = Store::findByStoreId($shopApi->id);
                $emstore->STORE_CARRIER_ID = $carrier['body']['carrier_service']['id'];
                $emstore->save();
            }
            
            $this->validateApi($request);

            #save meta data on store
            $meta  = $this->saveMetadata($settings);

            $scriptTag  = $this->registerScriptTags($shopApi->id);
            $emstore = Store::findByStoreId($shopApi->id);
            if ( $scriptTag  ){
                $emstore->STORE_SCRIPTTAG = $scriptTag['body']['script_tag']['id'];
                $emstore->save();
            }

            app('translator')->setLocale($settings->getLanguage());
            $request->session()->flash('success', __('servientrega.settings.save.success'));
            return redirect()->route('settings');

        } catch (Exception $e) 
        {
            Log::error("SettingController->save : ", [$e->getMessage()]);
            $request->session()->flash('myerror', __('servientrega.settings.save.failed'));
            return redirect()->route('settings');
        }
    }

    public function validateApi(Request $request){
        //get the data from form and api rest shopify
        $shop = Auth::user();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        $locations = $shop->api()->rest('GET', '/admin/locations.json')['body']['locations'];
        $data = $request->all();
        if(isset($data['params']) ){
            $data = $data['params'];
        }
        //get the primary location from api rest shopify 
        foreach($locations as $location){
            if($location['id'] == $shopApi['primary_location_id'] ){
                $address1=$location['address1'];
                $zip=$location['zip'];
                $city=$location['city'];
                break;
            }
        }
        if (!($settings = Setting::findByStoreId($shopApi->id))) {
            $settings = new Setting();
        }
        
        //Here your logic to validate the address 
        $isvalidAdress = 1;

        //here we save if the address is valid for our app
        //in this case will be true by default because it's the base project
        $settings->setStoreId($shopApi->id)
                 ->setValidated($isvalidAdress)
                 ->save();

        return true;

    }

    public function imageUploadPost(Request $request)
    {
        try{
            $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads'), $imageName);

            return $imageName;

        }
        catch(Exception $e){
            return false;
        }
        
    }

    public function adapterHollydays($setting, $storeid){

        $hollydays = [];
        #get setting record
        $emsettings = Setting::find($setting);

        if ( is_null($emsettings)){
            return [];
        }

        #get hollydays
        if ( $emsettings->hollydays()->exists() )
        {

            foreach ($emsettings->hollydays as $day)
            {
                $hollydays[] = [
                    'HODAY_HOLLYDAY'    => $day->HODAY_HOLLYDAY,
                    'HODAY_SETTING'     => $day->HODAY_SETTING,
                    'HODAY_DAY'         => $day->HODAY_DAY,
                    'HODAY_MONTH'       => $day->HODAY_MONTH,
                    'HODAY_CREATED_AT'  => $day->HODAY_CREATED_AT,
                ];
            }
        }

        return collect($hollydays);

    }

    // Save
    public function saveLocations($setting, $storeid, $postlocations=[])
    {
        if (!is_array($postlocations)) {
            return true;
        }

        #truncate
        Location::where('STLO_STOREID', $storeid)->delete();

        $size   = sizeof($postlocations);

        foreach ($postlocations as $postlocation) {
            $idlocation    = $postlocation['id'];
            $enabled       = isset($postlocation['enable']) ? 1 : 0;
            if (!$location = Location::find($idlocation)) {
                $location  = new Location();
            }

            $location->setSetting($setting);
            $location->setEnable($enabled);
            $location->setId($idlocation); //location ID
            $location->setStore($storeid); //Store ID
            $location->setName($postlocation['name']);
            $location->setAddress1($postlocation['adress1']);
            $location->setAddress2($postlocation['address2']);
            $location->setCountryName($postlocation['country']);
            $location->setProvince($postlocation['province']);
            $location->setPostCode($postlocation['postCode']);
            $location->setCity($postlocation['city']);
            $location->save();
        }

        return true;
    }

    public function adapterHours($setting)
    {
        $days           = [0,1,2,3,4,5,6];
        $workinhours    = [];
        #get working hours
        $settingworkinhours = collect(Hour::where('STHR_SETTING', $setting)->get());
        #if dont have values on setting working days. By default set values
        if ($settingworkinhours->count() == 0) {
            foreach ($days as $day) {
                $temp = [
                    'day'       => $day,
                    'enabled'   => false,
                    'hours'     => [
                        0 => ['open'=> '08:00', 'close'=> '13:00']
                    ],
                    'hours2'     => [
                        0 => ['open'=> '15:00', 'close'=> '18:00']
                    ],
                    'default' => [
                        0 => ['open'=> '08:00', 'close'=> '21:00']
                    ]
                ];
                $workinhours[$day] = $temp;
            }
        }
        #have setting values
        else {
            foreach ($days as $day) {
                $temp       = ['day' => $day];
                $hoursDay   = $settingworkinhours->where('STHR_DAY', $day)->first();
                if ($hoursDay['STHR_ENABLED'] == 1) {
                    $temp['enabled']   = true;
                    $temp['hours'][]   = ['open'=> $hoursDay['STHR_OPEN'], 'close'=> $hoursDay['STHR_CLOSE']];
                    $temp['hours2'][]   = ['open'=> $hoursDay['STHR_OPEN_T2'], 'close'=> $hoursDay['STHR_CLOSE_T2']];
                    $temp['default'][] = ['open'=> $hoursDay['STHR_OPEN'], 'close'=> $hoursDay['STHR_CLOSE']];
                    
                } else {
                    $temp['enabled']    = false;
                    $temp['hours'][]    = ['open'=> '08:00', 'close'=> '13:00'];
                    $temp['hours2'][]    = ['open'=> '15:00', 'close'=> '18:00'];
                    $temp['default'][]  = ['open'=> '08:00', 'close'=> '21:00'];
                }
                $workinhours[$day]= $temp;
            }
        }
        return collect($workinhours);
    }

    public function hasDoubleTurn($workinhours){
        foreach($workinhours as $day){
            if( $day["hours2"][0]["open"] == null &&  $day["hours2"][0]["close"]  == null){
                return false;
            }
        }
        return true;
    }

    public function adapterStoreLocations($shop, $shopApi)
    {
        $stores = [];
        try {
            $locations = $shop->api()->rest('GET', '/admin/locations.json')['body']['locations'];

            foreach ($locations as $location) {
                if($shopApi->primary_location_id == $location->id){
                    if ($location->active) {
                        $storelocation = new Location();
                        $storelocation->STLO_STOREID        = $shopApi->id;
                        $storelocation->STLO_ID             = $location->id;
                        $storelocation->STLO_NAME           = $location->name;
                        $storelocation->STLO_CITY           = $location->city;
                        $storelocation->STLO_ADDRESS1       = $location->address1;
                        $storelocation->STLO_ADDRESS2       = $location->address2;
                        $storelocation->STLO_POSTCODE       = $location->zip;
                        $storelocation->STLO_PHONE          = $location->phone;
                        $storelocation->STLO_PROVINCE       = $location->province;
                        $storelocation->STLO_PROVINCE_CODE  = $location->province_code;
                        $storelocation->STLO_COUNTRY        = $location->country;
                        $storelocation->STLO_COUNTRY_CODE   = $location->country_code;
                        $storelocation->STLO_COUNTRY_NAME   = $location->country_name;
                        $storelocation->LAT_ATTRIBUTES      = '';
                        $storelocation->LNG_ATTRIBUTES      = '';

                        array_push($stores, $storelocation);
                    }
                }
            }
            return collect($stores);
        } catch (Exception $e) {
        }
    }

    public function saveHorarios($setting, $storeid, $workingdays=[]){
        try
        {
            #truncate
            Hour::where('STHR_SETTING', $setting)->delete();

            #create
            foreach ($workingdays as $key=>$day){
                if( !is_int($key) ){ 
                    continue; 
                }
                $emhours    = new Hour();
                $emhours->STHR_SETTING  = $setting;
                $emhours->STHR_DAY      = $key;

                if ( isset($day['enabled']) )
                {
                    $emhours->STHR_ENABLED  = 1;
                    $emhours->STHR_OPEN     = $day['open'];
                    $emhours->STHR_CLOSE    = $day['close'];
                    if(isset($workingdays["doubleTurn"]) ){
                        if( $workingdays["doubleTurn"] == "on"){
                        $emhours->STHR_OPEN_T2  = $day['open2'];
                        $emhours->STHR_CLOSE_T2 = $day['close2'];
                        }
                        else{
                            $emhours->STHR_OPEN_T2  = DB::raw("NULL");
                            $emhours->STHR_CLOSE_T2 = DB::raw("NULL");
                        }
                    }
                    else{
                        $emhours->STHR_OPEN_T2  = DB::raw("NULL");
                        $emhours->STHR_CLOSE_T2 = DB::raw("NULL");
                    }
                }
                else
                {
                    $emhours->STHR_ENABLED  = 0;
                    $emhours->STHR_OPEN     = DB::raw("NULL");
                    $emhours->STHR_CLOSE    = DB::raw("NULL");
                    $emhours->STHR_OPEN_T2  = DB::raw("NULL");
                    $emhours->STHR_CLOSE_T2 = DB::raw("NULL");
                }

                $emhours->save();
            }

            return true;


        }
        catch (Exception $e){ }
        return true;

    }

    public function saveHollydays($setting, $storeid, $hollydays=[]){

        try
        {
            #truncate
            Holiday::where('HODAY_SETTING', $setting)->delete();

            #create
            if ( isset($hollydays['day'])  ){
                foreach ($hollydays['day'] as $key => $day) {
                    $emholly    = new Holiday();
                    $emholly->HODAY_SETTING  = $setting;
                    $emholly->HODAY_DAY      = $hollydays['day'][$key];
                    $emholly->HODAY_MONTH    = $hollydays['month'][$key];
                    $emholly->save();
                }
            }

        }
        catch (Exception $e)
        {

        }
        return true;

    }

     /**
     * @param EMVexsetting $emsetting
     * @return bool
     */
    public function saveMetadata(Setting $emsetting){

        $apishop = Auth::user();
        $apimetafields  = $apishop->api()->rest('GET', "/admin/metafields.json");
        $metafields     = collect($apimetafields['body']['metafields'])->keyBy('key');

        #---------------------------------------------------------------------------------------------------------------
        # SETTINGS
        #---------------------------------------------------------------------------------------------------------------
        if (is_null($meta =  $metafields->get('settingid'))  )
        {
            $metadata = array(
                'metafield' => array(
                    "namespace" => "servientrega",
                    "key"       => "settingid",
                    "value"     => $emsetting->getId(),
                    "value_type"=> "string",
                )
            );

            $apirest    = $apishop->api()->rest('POST',"/admin/metafields.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }else {

            $metadata = array(
                'metafield' => array(
                    "id"    => $meta['id'],
                    "value" => $emsetting->getId(),
                    "value_type" => "string",
                )
            );

            $apirest = $apishop->api()->rest('PUT', "/admin/metafields/{$meta['id']}.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }

        EMMetadata::where("META_STORE", $emsetting->getStoreId() )->where("META_KEY",'settingid')->delete();
        $emmetafield = new EMMetadata();
        $emmetafield->META_ID                = $metafield->id;
        $emmetafield->META_SETTING           = $emsetting->getId();
        $emmetafield->META_STORE             = $emsetting->getStoreId();
        $emmetafield->META_KEY               = $metafield->key;
        $emmetafield->META_VALUE             = $metafield->value;
        $emmetafield->META_TYPE              = $metafield->value_type;
        $emmetafield->META_OWNERID           = $metafield->owner_id;
        $emmetafield->META_OWNER_RESOURCE    = $metafield->owner_resource;
        $emmetafield->META_ADMIN_GRAPHQL     = $metafield->admin_graphql_api_id;
        $emmetafield->META_CREATED_AT        = Carbon::parse($metafield->created_at)->format('Y-m-d H:i:s');
        $emmetafield->save();



        #---------------------------------------------------------------------------------------------------------------
        # ALLOW SCHEDULE ORDERS
        #---------------------------------------------------------------------------------------------------------------
        if (is_null($meta =  $metafields->get('allowscheduled'))  )
        {
            $metadata = array(
                'metafield' => array(
                    "namespace" => "servientrega",
                    "key"       => "allowscheduled",
                    "value"     => $emsetting->getAllowScheduled()  ? 'yes' : 'no',
                    "value_type"=> "string",
                )
            );

            $apirest    = $apishop->api()->rest('POST',"/admin/metafields.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }else {

            $metadata = array(
                'metafield' => array(
                    "id"    => $meta['id'],
                    "value" => $emsetting->getAllowScheduled() ? 'yes' : 'no',
                    "value_type" => "string",
                )
            );

            $apirest = $apishop->api()->rest('PUT', "/admin/metafields/{$meta['id']}.json", $metadata);
            $metafield  = $apirest['body']['metafield'];    

        }

        EMMetadata::where("META_STORE", $emsetting->getStoreId() )->where("META_KEY",'allowscheduled')->delete();
        $emmetafield = new EMMetadata();
        $emmetafield->META_ID                = $metafield->id;
        $emmetafield->META_SETTING           = $emsetting->getId();
        $emmetafield->META_STORE             = $emsetting->getStoreId();
        $emmetafield->META_KEY               = $metafield->key;
        $emmetafield->META_VALUE             = $metafield->value;
        $emmetafield->META_TYPE              = $metafield->value_type;
        $emmetafield->META_OWNERID           = $metafield->owner_id;
        $emmetafield->META_OWNER_RESOURCE    = $metafield->owner_resource;
        $emmetafield->META_ADMIN_GRAPHQL     = $metafield->admin_graphql_api_id;
        $emmetafield->META_CREATED_AT        = Carbon::parse($metafield->created_at)->format('Y-m-d H:i:s');
        $emmetafield->save();



        #---------------------------------------------------------------------------------------------------------------
        # GOOGLE APIKEY
        #---------------------------------------------------------------------------------------------------------------
        if (is_null($meta =  $metafields->get('gloogleapikey'))  )
        {
            $metadata = array(
                'metafield' => array(
                    "namespace" => "servientrega",
                    "key"       => "gloogleapikey",
                    "value"     => !empty($emsetting->getGoogleApiKey()) ? $emsetting->getGoogleApiKey() : "X",
                    "value_type"=> "string",
                )
            );

            $apirest    = $apishop->api()->rest('POST',"/admin/metafields.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }else {

            $metadata = array(
                'metafield' => array(
                    "id"    => $meta['id'],
                    "value" => !empty($emsetting->getGoogleApiKey()) ? $emsetting->getGoogleApiKey() : "X",
                    "value_type" => "string",
                )
            );

            $apirest = $apishop->api()->rest('PUT', "/admin/metafields/{$meta['id']}.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }

        EMMetadata::where("META_STORE", $emsetting->getStoreId() )->where("META_KEY",'gloogleapikey')->delete();
        $emmetafield = new EMMetadata();
        $emmetafield->META_ID                = $metafield->id;
        $emmetafield->META_SETTING           = $emsetting->getId();
        $emmetafield->META_STORE             = $emsetting->getStoreId();
        $emmetafield->META_KEY               = $metafield->key;
        $emmetafield->META_VALUE             = $metafield->value;
        $emmetafield->META_TYPE              = $metafield->value_type;
        $emmetafield->META_OWNERID           = $metafield->owner_id;
        $emmetafield->META_OWNER_RESOURCE    = $metafield->owner_resource;
        $emmetafield->META_ADMIN_GRAPHQL     = $metafield->admin_graphql_api_id;
        $emmetafield->META_CREATED_AT        = Carbon::parse($metafield->created_at)->format('Y-m-d H:i:s');
        $emmetafield->save();



        #---------------------------------------------------------------------------------------------------------------
        # WORKING DAYS
        #---------------------------------------------------------------------------------------------------------------
        $getArrayWorkingDays = $this->getArrayWorkingDays($emsetting->getId());
        if (is_null($meta =  $metafields->get('workingdays'))  )
        {
            $metadata = array(
                'metafield' => array(
                    "namespace" => "servientrega",
                    "key"       => "workingdays",
                    "value"     => json_encode($getArrayWorkingDays),
                    "value_type"=> "string",
                )
            );

            $apirest    = $apishop->api()->rest('POST',"/admin/metafields.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }else {

            $metadata = array(
                'metafield' => array(
                    "id"    => $meta['id'],
                    "value" => json_encode($getArrayWorkingDays),
                    "value_type" => "string",
                )
            );

            $apirest = $apishop->api()->rest('PUT', "/admin/metafields/{$meta['id']}.json", $metadata);
            $metafield  = $apirest['body']['metafield'];

        }

        EMMetadata::where("META_STORE", $emsetting->getStoreId() )->where("META_KEY",'workingdays')->delete();
        $emmetafield = new EMMetadata();
        $emmetafield->META_ID                = $metafield->id;
        $emmetafield->META_SETTING           = $emsetting->getId();
        $emmetafield->META_STORE             = $emsetting->getStoreId();
        $emmetafield->META_KEY               = $metafield->key;
        $emmetafield->META_VALUE             = $metafield->value;
        $emmetafield->META_TYPE              = $metafield->value_type;
        $emmetafield->META_OWNERID           = $metafield->owner_id;
        $emmetafield->META_OWNER_RESOURCE    = $metafield->owner_resource;
        $emmetafield->META_ADMIN_GRAPHQL     = $metafield->admin_graphql_api_id;
        $emmetafield->META_CREATED_AT        = Carbon::parse($metafield->created_at)->format('Y-m-d H:i:s');
        $emmetafield->save();

        return true;
    }

    public function getWorkingDays($setting){

        $workingdays = [];

        #get working days and hours
        $settingworkindays = Hour::where('STHR_SETTING', $setting)->get();


        foreach ($settingworkindays as $wday){
            $temp       = [
                'day'       => $wday->STHR_DAY,
                'enabled'   => $wday->STHR_ENABLED,
                'hours' => [
                    0 => ['open'=> $wday->STHR_OPEN, 'close'=> $wday->STHR_CLOSE]
                ],
            ];
            $workingdays[$wday->STHR_DAY] = $temp;
        }


        return $workingdays;

    }

      
    public function getArrayWorkingDays($setting_id, $date=null, $productlist=[]){
        $workindays = collect([]);
        $hollydays  = collect([]);
        $days       = [0,1,2,3,4,5,6];
        
        $emsetting  = Setting::find($setting_id);
        $emstore    = Store::findByStoreId($emsetting->getStoreId());

        //translate texts
        app('translator')->setLocale($emsetting->getLanguage());
        Carbon::setLocale('en');

        $settingdays= $this->getWorkingDays($setting_id);

        if ( $emsetting->hollydays()->exists() )
        {
            $hollydays = collect( $emsetting->hollydays()->first()->getHollyDays() );
        }

        if (is_null($date))
        {
            $now        = Carbon::now( $emstore->getTimeZone() );
        }else
        {
            $now        = Carbon::parse( $date->format('Y-m-d H:i:s'), $emstore->getTimeZone() );
        }

        $dayofweek  = $now->dayOfWeek;

        // '0'   => 'Sunday',
        // '1'   => 'Monday',
        // '2'   => 'Tuesday',
        // '3'   => 'Wednesday',
        // '4'   => 'Thursday',
        // '5'   => 'Friday',
        // '6'   => 'Saturday',
        $wdays      = __('servientrega.workinghours.days');


        foreach ($days as $day){

            if ($day == 0){
                $immediately        = true;
                $enableday          = isset($settingdays[$now->isoFormat('d')])  ? ( $settingdays[$now->isoFormat('d')]['enabled'] ? true : false) : false;
                //rewrite
                if($hollydays->where('MDAY',$now->format('md'))->count()){
                    $enableday  = false;
                }else
                {
                    //get horarios disponibles
                    $horarios           = $this->getWorkingTimes($setting_id, $now->format('Ymd'), $productlist);
                    if ($horarios['success']==false){
                        $enableday  = false;
                    }

                    $immediately = $horarios['immediately'];
                }


                $workindays[$day]   = ['id' => $now->format('Ymd'), 'enable'=>false, 'immediately'=> $immediately, 'text'=> __('servientrega.workinghours.today')];


            }elseif ($day == 1){
                $cday               = $now->copy()->addDays($day);
                $cday->locale('es');
                $cdaystring = $cday->toDateTimeString();
                $enableday          = isset($settingdays[$cday->isoFormat('d')]) ? ($settingdays[$cday->isoFormat('d')]['enabled'] ? true : false) : false;
                
                if($hollydays->where('MDAY',$cday->format('md'))->count()){
                    $enableday  = false;
                }

                $workindays[$day]   = ['id' => $cday->format('Ymd'), 'enable'=>$enableday, 'text'=> __('servientrega.workinghours.tomorrow')];
            }else {
                $cday               = $now->copy()->addDays($day);
                $cday->locale('es');
                $cdaystring = $cday->toDateTimeString();
                $enableday          = isset($settingdays[$cday->isoFormat('d')]) ? ($settingdays[$cday->isoFormat('d')]['enabled'] ? true : false) : false;

                //rewrite
                if($hollydays->where('MDAY',$cday->format('md'))->count()){
                    $enableday  = false;
                }
                $cday->locale($emsetting->getLanguage());
                $workindays[$day]   = ['id' => $cday->format('Ymd'), 'enable'=>$enableday,  'text'=> ucfirst($cday->isoFormat('dddd').', '.$cday->isoFormat('DD') )];
            }
        }


        return $workindays;

    }


    /**
     * @param int $setting
     * @param string $day 20190201 Ymd
     * @param array $productlist [1323213123, 21324324, 324324324]
     * @return array
     */
    public function getWorkingTimes($setting, $day, $productlist){
        $immediately    = true;
        $arrayhours     = [];
        $arrayhours2    = [];
        $max_time       = 0;
        $ranges         = 1; //hours
        $now            = Carbon::now(); //Local setting eje. (GMT-05:00) Eastern Time (US & Canada) America/New_York
        //$now = Carbon::createFromFormat('Ymd H:i', "20200813 14:00");
        $dtStar         = null;
        $dtStop         = null;
        $stop           = 50;
        $doubleTurn     = true;

        try
        {

            if(empty($day))
            {
                return   ['success'=>false, 'hours'=>[], 'errors'=>['message'=>'invalid day']];
            }

            $emsetting   = Setting::find($setting);
            if ($emsetting->workinghours()->count() == 0){
                return   ['success'=>false, 'immediately'=>false, 'hours'=>[], 'errors'=>['message'=>'service not available']];

            }

            $store  = Store::findByStoreId($emsetting->getStoreId());
            $now->setTimezone($store->getTimeZone());
            

            $setting_days = $emsetting->workinghours()->first()->getWorkingDays('all');
            $meta_times   = Productmetadata::whereIn('PROD_PRODUCT', $productlist)->where('PROD_METADATA_KEY', 'preparation_time')->get();

            #max preparation time
            if ($meta_times)
            {
                foreach ($meta_times as $pmeta){
                    if ($pmeta->PROD_METADATA_VALUE > (int)$max_time ){
                        $max_time = (int)$pmeta->PROD_METADATA_VALUE;
                    }
                }
            }


            #take a day selected
            $fromNow        = Carbon::createFromFormat('Ymd H:i', $day. $now->format('H:i'), $store->getTimeZone() );
            $dayselected    = $fromNow->dayOfWeek;
            $setting_day    = $setting_days[$dayselected];

            if (!$setting_day['enabled'])
            {
                return   ['success'=>false, 'immediately'=>true, 'hours'=>[], 'errors'=>['message'=>"day {$dayselected} is not avaliable"]];
            }


            //for the same day (today)
            if ($now->format('Ymd') == $fromNow->format('Ymd'))
            {
                $dopen          = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['open'], $store->getTimeZone());
                $dclose         = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['close'],$store->getTimeZone() );
                
                if( isset($setting_day['hours'][0]['open2']) && isset($setting_day['hours'][0]['close2']) ){
                    $dopen2     = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['open2'], $store->getTimeZone());
                    $dclose2    = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['close2'],$store->getTimeZone());
                }
                else{
                    $doubleTurn = false;
                }
               

                if($now->gt($dopen)){
                    $dopen  = $now->clone();//->ceilUnit('minutes',30);
                }

                //service not available
                if($doubleTurn)
                {
                    if ( $now->gt($dclose2) )
                    {
                        return  ['success'=>false, 'hours'=>[],'immediately'=>true,  'errors'=>['message'=>'service not available']];
                    }
                }
                else{
                    if ( $now->gt($dclose) )
                    {
                        return  ['success'=>false, 'hours'=>[],'immediately'=>true,  'errors'=>['message'=>'service not available']];
                    }
                }
            }else{
                //for other day
                $dopen          = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['open'] , $store->getTimeZone());
                $dclose         = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['close'] , $store->getTimeZone());

                if( isset($setting_day['hours'][0]['open2']) && isset($setting_day['hours'][0]['close2']) ){
                    $dopen2     = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['open2'], $store->getTimeZone());
                    $dclose2    = Carbon::createFromFormat('Ymd H:i', $fromNow->format('Ymd') . " ". $setting_day['hours'][0]['close2'],$store->getTimeZone());
                }
                else{
                    $doubleTurn = false;
                }
               
            }

            //Preparation Time
            if ($max_time > 0){
                // open  09:00
                // preparation time = 45min
                // (open + preparation time) 09:45
                // start service = 09:45
                $dtStar     = $dopen->copy()->addMinutes($max_time);//->ceilUnit('minutes',$max_time);
                if($doubleTurn){
                    $dtStar2     = $dopen2->copy()->addMinutes($max_time); //Segundo Turno
                }

                // close 22:00
                // preparation time 45min
                // (close - preparation) = 21:15
                // last service until = 21:15

                $dtStop     = $dclose->clone()->subMinutes($max_time);
                if($doubleTurn){
                $dtStop2     = $dclose2->clone()->subMinutes($max_time);
                }


            }else
            {
                $dtStar     = $dopen->clone();
                $dtStop     = $dclose->clone();
                //Turno 2
                if($doubleTurn){
                    $dtStar2     = $dopen2->clone();
                    $dtStop2     = $dclose2->clone();
                }
            }

            # [09:45, 10:00, 10:30, 11:00, 12:00, 13:00, 14:00, 15:00, 16:00, 17:00, 18:00, 19:00, 20:00, 21:00, 21:15]
            # pueden ser rangos de 30min

            //si despues del ajuste, no se excede a la hora de cierre
            // Se determina el primer turno
            if ($dtStar->lte($dclose)){
                $arrayhours[] = ['id'=>$dtStar->format('YmdHi'), 'text'=>$dtStar->format('H:i'). " - " . $dtStar->addHour()->minute(0)->second(0)->format('H:i')];
            }
            if($doubleTurn){
                if ($dclose2->gt($now) && $now->gte($dtStar2) && $now->format('Ymd') == $fromNow->format('Ymd') ){
                    $dtStar2 =  $now->addMinutes($max_time);
                    $arrayhours2[] = ['id'=>$dtStar2->format('YmdHi'), 'text'=>$dtStar2->format('H:i'). " - " . $now->addHour()->minute(0)->second(0)->format('H:i')];
                }
                else{
                    $arrayhours2[] = ['id'=>$dtStar2->format('YmdHi'), 'text'=>$dtStar2->format('H:i'). " - " . $dtStar2->addHour()->minute(0)->second(0)->format('H:i')];
                }
            }
            //Log::critical('start',[$dtStar]);
            //Log::critical('array',$arrayhours);
            

            if($doubleTurn){
                if ($now->gte($dopen) && $now->lte($dclose2)){
                    $immediately = true;
                }
            }
            else{
                if ( $now->gte($dopen) ){
                    $immediately = true;
                }
            }

            //calculate ranges hours
            $i=0;
            while (  $dtStar <  $dtStop)
            {
                $arrayhours[] = ['id'=>$dtStar->format('YmdHi'), 'text'=>$dtStar->format('H:i') . " - " . $dtStar->clone()->addMinutes(60)->format('H:i')];
                if ( $dtStar->clone()->addMinutes(60) >=  $dtStop){
                    break;
                }
                $dtStar->addMinutes(60);
            }

            if($doubleTurn){
                while (  $dtStar2 <  $dtStop2)
                {
                    if( $dtStar2->gte($now) ){
                        $arrayhours2[] = ['id'=>$dtStar2->format('YmdHi'), 'text'=>$dtStar2->format('H:i') . " - " . $dtStar2->clone()->addMinutes(60)->format('H:i')];
                    }
                
                    if ( $dtStar2->clone()->addMinutes(60) >=  $dtStop2 ){
                        break;
                    }
                    $dtStar2->addMinutes(60);
                }
            }
            $arrayhours= array_merge($arrayhours,$arrayhours2);
            return ['success'=>true, 'immediately' =>$immediately, 'hours'=>$arrayhours];
        }
        catch (Exception $e)
        {

        }


        return ['success'=>false, 'immediately' =>false, 'hours'=>[]];
    }

  

    

    public function createCarrierService(Setting $settings, $currentMethodTitle)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $carrierServices = $shop->api()->rest('GET', '/admin/carrier_services.json');
        $carrierServices = $carrierServices['body']['carrier_services'];
        $exist = false;
        $carrier = array (
            "carrier_service" => [
                "name" => $settings->getMethodTitle(),
                "callback_url" =>  env('SHOPIFY_APP_URL')."/api/create/carrierService",
                "format"            => "json",
                "carrier_service_type" => "api",
                "service_discovery" => "true",
                "active"            => "true"
            ]
        );
        foreach($carrierServices as $currentCarrier){
            if($currentCarrier['name'] == $settings->getMethodTitle()){
                $exist = true;
                break;
            }
        }

        if(sizeof($carrierServices) == 0 || !$exist){
            $response = $shop->api()->rest('POST', '/admin/carrier_services.json', $carrier);
        }
        else{
            foreach($carrierServices as $carrierService){
                if($carrierService['name'] == $currentMethodTitle){
                    $id = $carrierService['id'];
                }
            }
            try{
                $response = $shop->api()->rest('DELETE', "/admin/carrier_services/{$id}.json");
            }
            catch(Exception $e){
            }
            $response = $shop->api()->rest('POST', "/admin/carrier_services.json", $carrier);

        }

        return $response;
    }

    
    

    public function initDefaultHours($shop, $shopifyshop, $setting){

        $workingdays = [
            0   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
            1   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
            2   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
            3   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
            4   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
            5   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
            6   => ['enabled'=>1, 'open'=> '08:00', 'close'=>'13:00', 'open2'=> '18:00', 'close2'=>'21:00'],
        ];
        $workingdays["doubleTurn"] = "on";
        $trans = $this->saveHorarios($setting->getId(), $shopifyshop->id, $workingdays);

    }

    /**
     * Register ScriptTags
     * @param $store_id
     * @return bool
     */
    public function registerScriptTags($store_id){
        $shop = Auth::user();
        //retrive and remove if already exits
        $apiscriptags   = $shop->api()->rest('GET', "/admin/script_tags.json");
        $scriptags        = collect($apiscriptags['body']['script_tags'])->keyBy('id');

        $deleted = [];
        foreach ($scriptags as $scriptag) {
            // This remove the all scripts tags
            $shop->api()->rest('DELETE', "/admin/script_tags/{$scriptag['id']}.json");
            $deleted[] = $scriptag;
        }


        //register the script tags
        $scripttag = array(
            'script_tag' => array(
                "event"    => "onload", //
                "src"      => env('SHOPIFY_APP_URL')."/js/servientregadelivery-v1.0.js",
            )
        );


        $script = $shop->api()->rest('POST', '/admin/script_tags.json', $scripttag);

        if ( $script['errors']){
            return false;
        }

        return $script;

    }

    public function deleteImage(Request $request){
        $shop = Auth::user();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        $settings = Setting::findByStoreId($shopApi->id);
        
        $data = $request->all();
        if(isset($data['params']) ){
            $data = $data['params'];
            $image_path = public_path('uploads/'.$data['image']);
            try{
                if( file_exists ($image_path) ){
                    unlink($image_path);
                    $settings->setImage(DB::raw("NULL")) 
                    ->save();
                    return ["success" => "ok"];
                }
                else{
                    $settings->setImage(DB::raw("NULL")) 
                    ->save();
                    return ["success" => "ok"];
                }
            }
            catch(Exception $e){
                return ["error" => "error"];
            }
        }
    }

    public function clearSettings ($store_id){
        $emsettings = Setting::findByStoreId($store_id);
        if ($emsettings)
        {
            if( !$emsettings->trashed() ){
                $emsettings->locations()->delete();
                $emsettings->workinghours()->delete();
                $emsettings->hollydays()->delete();
                $emsettings->metadata()->delete();
                $emsettings->delete();
            }
        }
        return true;
    }

    public function initialize($shop, $shopifyshop){

        try
        {
            $default_lang   = UStore::DefLang($shopifyshop);
            $emsetting = new Setting();
            $emsetting->setStoreId( $shopifyshop->id)
                ->setStoreName( $shopifyshop->name )
                ->setLanguage( $default_lang )
                ->setCountry(1)
                ->setEnable(1)
                ->setServer('Production')
                ->setServientregaApi("")
                ->setServientregaSecret("")
                ->setServientregaBillingCode("")
                ->setGoogleApiKey("")
                ->setMethodTitle(env("SHOPIFY_SHIPPING_TITLE"))
                ->setMethodDescription(env("SHOPIFY_SHIPPING_TITLE"))
                ->setCostType("Free")
                ->setCostDefault("0")
                ->setAllowScheduled(1)
                ->setAllowFirstWidget(0)
                ->setAllowSecondWidget(0)
                ->setCreateStatus("paid")
                ->save();

            $this->saveMetadata($emsetting);

            #save working days
            $this->initDefaultHours($shop, $shopifyshop, $emsetting);

        }
        catch (Exception $e)
        {
            Log::critical('Error ocurren in controller ShopifySettingsController@initialize', [$e]);
        }


        return $emsetting;
    }


}



