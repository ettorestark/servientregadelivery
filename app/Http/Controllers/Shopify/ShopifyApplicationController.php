<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Servientrega\ServientregaCotizadorController;
use App\Http\Controllers\Shopify\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppInstalled;

use App\Vexsolutions\Helpers\Dates;
use App\Models\Setting;
use App\Models\Productmetadata;
use App\Models\Country;
use App\Models\Store;
use App\User;
use Carbon\Carbon;
use Log;
use \Exception;

class ShopifyApplicationController extends Controller
{
    public function getRate(Request $request)
    {
        try
        {
            $domain = $request->server()["HTTP_X_SHOPIFY_SHOP_DOMAIN"];
            $data = $request->all()['rate'];
            $currency = $data['currency'];
            $origin = $this->formatAddress( $data['origin'] );
            $destination = $this->formatAddress( $data['destination'] );
            $totalPrice = $this->getTotalPrice( $data['items'] );

            $store = new Store;
            $emstore = $store->findByDomain($domain);

            if (is_null($emstore)){
                throw new Exception("Invalid domain: {$domain} -> not found in the database", 4004);
            }
            
            $storeTimeZone = $emstore->getTimeZone();
            $now = Carbon::now($storeTimeZone);

            $settings = Setting::findByStoreId($emstore->getId());
            if (!is_null($settings)) {
                $methodTitle = $settings->getMethodTitle();
                $description = $settings->getMethodDescription();
                $costType = $settings->getCostType();

                $server                  = $settings->getServer();
                $api_client_id           = $settings->getServientregaApi();
                $api_client_secret       = $settings->getServientregaSecret();
                $api_client_billing_code = $settings->getServientregaBillingCode();
                $servientregaCotizador   = new ServientregaCotizadorController($server, $api_client_id, $api_client_secret, $api_client_billing_code );

                $orderInfo = $this->setOrderInfo($data['items'], $totalPrice);

                $estimate = $servientregaCotizador->getPricing($origin, $destination, $orderInfo);

                if ($estimate['validate'] !== true){
                    throw new Exception($estimate['error']['message']);
                }
                if ( $costType == 'Free' )
                {
                    $totalPrice = 0000;
                }
                elseif( $costType == "Freefor"){
                    $freeFor = $settings->getFreeForDefault() * 100;
                    if( $totalPrice > $freeFor ){
                        $totalPrice = 0000;
                    }
                    else{
                        $totalPrice = round( $estimate['price'], 2) * 100; 
                        $currency = $estimate['currency'];  
                    }
                }
                elseif ( $costType == 'Fixed' ){
                    $totalPrice = $settings->getCostDefault() * 100;
    
                }elseif ( $costType == 'Calculate' ){
                    //cart items
                    $totalPrice = round( $estimate['price'], 2) * 100; 
                    $currency = $estimate['currency'];    
                }
                elseif ( $costType == 'Percentage' ){
                    $percentage = $settings->getPercentageDefault();
                    $totalPrice = $totalPrice * ( abs($percentage) / 100 );
                }

                $rates = [
                    "rates" => [
                        "service_name"  => $methodTitle,
                        "service_code"  => "ON",
                        "total_price"   => $totalPrice,
                        "description"   => $description,
                        "currency"      => $currency,
                        "min_delivery_date" => $now,
                        "max_delivery_date" => $now,
                    ]
                ];
                return $rates;
            }
        }
        catch(Exception $e){

        }

        return null;
    }

    public function setOrderInfo( $items, $totalPrice){
        $orderInfo = [
            'items'      => $items,
            'totalPrice' => $totalPrice/100,
        ];
        return $orderInfo;
    }

    public function formatAddress($address){
        $address1 = $address['address1'];
        $city = $address['city'];
        $province = $address['province'];
        $postalCode = $address['postal_code'];
        $country = $address['country'];
        return "{$city}";
    }

    public function getTotalPrice($items){
        $totalPrice = 0;
        foreach($items as $item){
            $totalPrice += $item["quantity"] * $item["price"];
        }
        return $totalPrice;
    }

     /**
     * Get the working hours of especific day
     * @usage in Front-End
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWorkingTimes(Request $request){
        $data = $request->all();
        $domain             = $data['shop'];
        $productlist        = $data['products'];
        $day                = $data['day']; //day of week
        $productlist        = collect(json_decode($productlist));

        if (!$domain or $productlist->count() == 0){
            return response()->json(['status'=> ['code'=>410]], 200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Headers', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }


        $emstore            = Store::findByDomain($domain);
        if (!$emstore){
            return response()->json(['status'=> ['code'=>410]], 200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Headers', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }

        $emsetting          = Setting::findByStoreId($emstore->getId());
        $csetting           = new SettingController();
        $response           = $csetting->getWorkingTimes($emsetting->getId(), $day, $productlist->pluck('product_id')->toArray());

        return response()->json($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }


    /**
     * Load array of working days from now
     * is used en shoping cart
     * @param idsetting
     */
    public function getWorkingDays(Request $request){
        $data = $request->all();
        $shopDomain =  $data['shop'];

        $store = new Store();
        $store = $store->findByDomain($shopDomain);

        $settings = new Setting;
        $shopId = $store->getId();
        $settings = $settings->findByStoreId($shopId);

        $csetting   = new SettingController();
        $array      = $csetting->getArrayWorkingDays($settings->getId());


        return response()->json($array, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');



    }
    
    
    public function getProductAvaliable(Request $request){
        $data = $request->all();
        $domain  = $data['shop'];
        $id_product = $data['product'];

        if (is_null($id_product) ){
            return $response=['status'=> ['code'=>401, 'message' =>'No product submited']];
        }
        $localstore     = Store::findByDomain($domain);
        if (!$localstore){
            Log::critical('Not found - domain');
            Log::critical('getProductAvaliable - domain', [$domain]);
            Log::critical('getProductAvaliable - variant', [$variant]);
            Log::critical('getProductAvaliable - localstore', [$localstore]);

            return response()->json(['status'=> ['code'=>410]], 200)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }

        $settings = Setting::findByStoreId($localstore->getId());
        if( !$settings->getAllowFirstWidget()){
            $response = [ 'status'=>['code'=>304,'message'=>'Not active'] ];
            return response()->json($response, 304)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }

        app('translator')->setLocale($settings->getLanguage());

        if ($settings->getEnable() != 1){
            return $response=['status'=> ['code'=>401, 'message' =>'Not enable servientrega delivery']];
        }
        
        try{
            $meta_times = Productmetadata::where('PROD_PRODUCT', $id_product )->where('PROD_METADATA_KEY', 'available_for_servientrega')->first();
            if($meta_times != null){
                $meta_times = $meta_times->toArray();
                $avaliable = $meta_times['PROD_METADATA_VALUE'];
            }
            else{
                $avaliable = false;
                $response = [ 'status'=>['code'=>400,'message'=>'No porduct finded'] ];
            }
            if($avaliable){
                $snippet_product = view('partials.snippet-product', ["settings" => $settings ] )->render();
                $response = [ 'status'=>['code'=>200,'message'=>'OK'], "snippet" => $snippet_product ];
            }
        }
        catch(Exception $e){
            $response = [ 'status'=>['code'=>400,'message'=>'No porduct finded'] ];
        }

        return response()->json($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

   

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

    //this method is for create the snippet
    public function getThemesDefault($shop)
    {
        app('translator')->setLocale('en');

        $themes = $shop->api()->rest('GET', '/admin/themes.json');
        $activeThemeId = "";
        foreach ($themes['body']->container['themes'] as $theme) {
            if ($theme['role'] == "main") {
                $activeThemeId = $theme['id'];
            }
        }    
        $snippet = view('partials.snippet')->render();
        //if you use liquide language
        $snippet = str_replace( "@{", "{", $snippet);
        $dataSnippet = array('asset' => array('key' => 'snippets/vexsoluciones-servientrega-delivery-cart.liquid', 'value' => $snippet));

        $shop->api()->rest('PUT', '/admin/themes/'.$activeThemeId.'/assets.json', $dataSnippet);

        return ['message' => 'setup succesfull'];
    }


    public function onInstall($shop, $shopifyshop, $shop_id){
        try
        {
            #-----------------------------------------------------------------------------------------------------------
            # MARCA COMO INSTALADA POR PRIMERA VEZ
            #-----------------------------------------------------------------------------------------------------------
            $store  = Store::find($shop_id);
            if ( $store ) {
                if($store->STORE_INSTALLED == 1) {
                    return true;
                }
                if($store->STORE_INSTALLED  == 0) {
                    $store->STORE_INSTALLED  = 1;
                    $store->STORE_UNINSTALED = 0;
                    $store->save();
                }
            }

            #NO SE ENCUENTRE INSTALADA EN LA TIENDA
            if (is_null($store))
            {
                $store  =  new Store();
                $store->STORE_ID            = $shop_id;
                $store->STORE_DOMAIN        = $shop->getDomain()->toNative(); //hay diferencias entre el dominio de la api y el objeto shop
                $store->STORE_TIMEZONE      = $shopifyshop->timezone;
                $store->STORE_IANA_TIMEZONE = $shopifyshop->iana_timezone;

                $store->STORE_INSTALLED = 1;
                $store->STORE_INSTALED_DATE = \DB::raw('now()');
                $store->save();
            }
            #-----------------------------------------------------------------------------------------------------------
            # SI TIENE SETTINGS LOS RECUPERA
            #-----------------------------------------------------------------------------------------------------------
            $settings   = Setting::findByStoreId($shop_id);
            if ($settings)
            {
                if ( $settings->trashed() ){
                    $settings->restore();
                }
            }


            #-----------------------------------------------------------------------------------------------------------
            # No existe la configuracion de la tienda
            # Crea la primera configuracion predeterminada para la tienda
            #-----------------------------------------------------------------------------------------------------------
            if (is_null($settings)){

                $csetting   = new SettingController();
                $csetting->initialize($shop, $shopifyshop);
            }
            else
            {
                $csetting   = new SettingController();
                $csetting->saveMetadata($settings);

                #save default working days
                $csetting->initDefaultHours($shop, $shopifyshop, $settings);

            }

           
            #-----------------------------------------------------------------------------------------------------------
            # CREA EL SCRIPT TAG
            #-----------------------------------------------------------------------------------------------------------
            $scriptTag  = $this->registerScriptTags($shop_id);

            if ( $scriptTag  ){
                $store->STORE_SCRIPTTAG = $scriptTag['body']['script_tag']['id'];
                $store->save();
            }

            #-----------------------------------------------------------------------------------------------------------
            # CREA EL WEBHOOK DE ORDENES
            #-----------------------------------------------------------------------------------------------------------
            $this->createWebHookOrders();

            #-----------------------------------------------------------------------------------------------------------
            # CREA EL WEBHOOK DE CARRIER SERVICE
            #-----------------------------------------------------------------------------------------------------------
            $currentMethodTitle = env('SHOPIFY_SHIPPING_TITLE');
            $carrier = $this->createCarrierService($currentMethodTitle);
            if ( $carrier ) {
                $emstore = Store::findByStoreId($shop_id);
                $emstore->STORE_CARRIER_ID = $carrier['body']['carrier_service']['id'];
                $emstore->save();
            }


            try
            {
                Mail::to('josepalonzoalonzo@icloud.com')->queue(new AppInstalled($shopifyshop));

            }catch (Exception $e)
            {
                Log::critical('Sending Mail failed : ' .$e->getMessage() );
            }


        }
        catch (Exception $e)
        {
            Log::critical('onInstall Exception ocurred', [$e]);
            Log::critical('onInstall Exception ocurred', [ $e->getMessage() ]);
        }

    }


    public function createCarrierService($currentMethodTitle)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $carrierServices = $shop->api()->rest('GET', '/admin/carrier_services.json');
        $carrierServices = $carrierServices['body']['carrier_services'];
        $exist = false;
        $carrier = array (
            "carrier_service" => [
                "name" => $currentMethodTitle,
                "callback_url" =>  env('SHOPIFY_APP_URL')."/api/create/carrierService",
                "format"            => "json",
                "carrier_service_type" => "api",
                "service_discovery" => "true",
                "active"            => "true"
            ]
        );
        foreach($carrierServices as $currentCarrier){
            if($currentCarrier['name'] == $currentMethodTitle){
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

    public function createWebHookOrders()
    {
        $shop = Auth::user();
        $webhooks = $shop->api()->rest('GET', '/admin/webhooks.json');
        $webhooks = $webhooks['body']['webhooks'];
        $count = $shop->api()->rest('GET', "/admin/api/2020-07/webhooks/count.json", ["topic" => "orders/paid"])['body']['count'];
        
        $webhookArray = array( 
            "webhook"=>[
            "topic" => "orders/paid",
            "address" => env('SHOPIFY_APP_URL')."/api/create/webhook/order",
            "format" => "json"
            ]
        );
        if($count == 0){
            $response = $shop->api()->rest('POST', "/admin/webhooks.json", $webhookArray);
        }
        else{
            foreach($webhooks as $webhook){
                if($webhook['topic'] == "orders/paid"){
                    $id = $webhook['id'];
                }
            }
            $response = $shop->api()->rest('DELETE', "/admin/webhooks/{$id}.json");
            $response = $shop->api()->rest('POST', "/admin/webhooks.json", $webhookArray);
        }
        return ['message' => $response];        
    }

    //this method is for create the snippet
    public function configureTheme(Request $request)
    {
        $max_weight   = 68000;
        $total_weight = 0;
        $data         = $request->all();
        $shop         = User::where('name', '=', $data['shop'])->first();
        $shopApi      = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        $productlist  = $data['productlist'];
        $variantlist  = $data['variantlist'];
        $productlist  = json_decode($productlist, true);
        $variantlist  = json_decode($variantlist, true);
        $cart         = json_decode($data['cart'], true);
        $total_weight = $cart['total_weight'];

        $settings  = Setting::findByStoreId($shopApi->id);

        if( !$settings->getAllowSecondWidget() ){
            $response = [ 'status'=>['code'=>304,'message'=>'Not active'] ];
            return response()->json($response, 304)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }

        $servientrega_shipping_available_items = false;
        $metaProducts = Productmetadata::whereIn('PROD_PRODUCT', $productlist)->where('PROD_METADATA_KEY', 'available_for_servientrega')->get();

        //Revisar si hay algun producto disponible
        if (!empty($metaProducts->items) )
        {
            foreach ($metaProducts as $pmeta){
                if ($pmeta->PROD_METADATA_VALUE == true ){
                    $servientrega_shipping_available_items = true;
                    break;
                }
            }
        }

        app('translator')->setLocale($settings['SETT_LANGUAGE']);

        
        $snippet = view('partials.snippet', ["img" => $settings->getImage(), "settings" => $settings, "servientrega_shipping_available_items"=> $servientrega_shipping_available_items, "total_weight"=> $total_weight] )->render();
        $response = [ 'status'=>['code'=>200,'message'=>'OK'], "snippet" => $snippet ];

        
        return response()->json($response, 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

    }


    public function onUnInstall($shop_id){
        try
        {
            $store  = Store::find($shop_id);
            if (!$store){
                return false;
            }
            if ( $store ){
                if($store->STORE_INSTALLED == 0) {
                    return true;
                }
                if($store->STORE_INSTALLED == 1) {
                    $store->STORE_INSTALLED = 0;
                    $store->save();
                }
            }

            #-----------------------------------------------------------------------------------------------------------
            # MARCA COMO INSTALADA
            #-----------------------------------------------------------------------------------------------------------
            $store->STORE_INSTALLED       = 0;
            $store->STORE_UNINSTALED      = 1;
            $store->STORE_UNINSTALED_DATE = \DB::raw('now()');
            $store->save();


            #-----------------------------------------------------------------------------------------------------------
            # BORRAR LOS SETTINGS
            #-----------------------------------------------------------------------------------------------------------
            $settings = new SettingController();
            $settings->clearSettings($shop_id);


        }
        catch (Exception $e)
        {
        }
        return true;
    }



}

