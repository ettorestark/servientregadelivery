<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Servientrega\ServientregaController;
use App\Http\Controllers\Shopify\EmailController;
use App\Http\Controllers\Soap\SoapController;

use App\Models\Productmetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vexsolutions\Helpers\UStore;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Country;
use App\Models\Store;
use App\Models\Location;
use Carbon\Carbon;
use Log;
use Exception;

class OrderController extends Controller
{
    protected $recordsPerPage = 10;

    /**
     *
     * @return View
     */
    
    public function index(Request $request)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        
        $settings = Setting::findByStoreId($shopApi->id);

        if ( is_null($settings) or ( empty($settings->getServientregaApi()) or empty($settings->getServientregaSecret()) ) )
        {
            return redirect()->route('settings');
        }

        $orders = Order::where('store_id', $shopApi->id)
        ->orderBy('created_at','DESC')
        ->paginate($this->recordsPerPage);
        
        $store = new Store;
        $emstore = $store->findByStoreId($shopApi->id);
        $storeTimeZone = $emstore->getTimeZone();
        $this->defLanguage($settings, $shopApi);
        return view('shopify.orders',[
            "orders" => $orders,
            "storeTimeZone" => $storeTimeZone,
            "language" => $settings->getLanguage()
        ]);
    }

    public function orderDetail($id_orden, $id_shipping=false){
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];
        $order = $shop->api()->rest('GET', "/admin/orders.json", ["ids" => $id_orden] )['body']['orders'][0];
        $orderdb = Order::where('id', $id_orden)->first();
        $products = $shop->api()->rest('GET', "/admin/products.json" )['body']['products'];
        $location = $shop->api()->rest('GET', "/admin/locations/{$shopApi['primary_location_id']}.json")['body']['location'];
        $settings = Setting::findByStoreId($shopApi->id);
        $servientregaDelivery = false;

        if($id_shipping){
            $servientrega = $this->initServientrega($settings, $domain, true);
            $servientregaDelivery = $servientrega->Consultar_guia_externo($id_shipping)->ConsultarGuiaExternoResult;
        }

        $store = new Store;
        $emstore = $store->findByStoreId($shopApi->id);
        $storeTimeZone = $emstore->getTimeZone();
        $this->defLanguage($settings,$shopApi);

        return view('shopify.orderDetail', [
            "order" => $order,
            "orderdb" => $orderdb,
            "products" => $products,
            "location" => $location,
            "storeTimeZone" => $storeTimeZone,
            "language" => $settings->getLanguage(),
            "servientregaDelivery" => $servientregaDelivery
        ]);
    }

    public function create(Request $request){
        $data = $request->all();
        $domain = $request->server()["HTTP_X_SHOPIFY_SHOP_DOMAIN"];
        $this->sendServientrega($data, false, $domain);
    } 

    public function resendServientrega(Request $request){
        $data = $request->all();
        $order_id = $data['order_id'];
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

        $order = $shop->api()->rest('GET', "/admin/orders.json", ["ids" => $order_id] )['body']['orders'][0]['container'];
        $settings = Setting::findByStoreId($shopApi->id);
        $this->defLanguage($settings, $shopApi);

        if( $response = $this->sendServientrega($order, true, $domain) ){
            if($response['success']){
                $request->session()->flash('success', str_replace( "#", $order['name'] ,__('servientrega.orderdetail.create.success') ) );
            }
            else{
                if(isset($response['guia']->arrayGuias))
                {
                    $request->session()->flash('myerror', __('servientrega.orderdetail.create.fail') . $response['guia']->arrayGuias->string  );
                }
            }
        }
        else{
            $request->session()->flash('myerror', __('servientrega.orderdetail.create.fail') );
        }
        return back();
    }

    public function sendServientrega($data, $resend=false, $domain=null){
        $servientrega_max_weight = 68000;
        $shippingInformation = $data['shipping_address'];
        $shipping_address= $this->addressFormat($shippingInformation);
        $notes = collect($data['note_attributes'])->keyBy('name');
        $comment =  ($notes->has('comment'))? $notes['comment']['value'] : null;
        $scheduling =  ($notes->has('immediately'))? false : true;
        $email =  ( isset($data['email']) )? $data['email'] : null;
        $available_for_servientrega = ($notes['order_available_for_servientrega']['value'] == "1" )? true : false;
        $items = $data['line_items'];
        
        $fechaDeseada = substr(Carbon::now()->toDateTimeString(), 0, -3);
        if( isset($notes['day']['value']) && isset($notes['hour']['value']) ){
            $hour    = substr($notes['hour']['value'], 8,2); 
            $minutes = substr($notes['hour']['value'], 10,2); 
            $fecha = "{$notes['day']['value']} {$hour}:{$minutes}";
            $fechaDeseada = substr(Carbon::createFromFormat('Ymd H:i', $fecha)->toDateTimeString(), 0, -3); 
        }
        
        // if(!$available_for_servientrega || $data['total_weight'] > $servientrega_max_weight){
        //     die;
        // }
        $methodTitle = $data["shipping_lines"][0]["title"];
       
        $store = new Store;
        $emstore = $store->findByDomain($domain);

        if (is_null($emstore)){
            throw new Exception("Invalid domain: {$domain} -> not found in the database", 4004);
        }
        $settings = Setting::findByStoreId($emstore->getId());
        $orders   = Order::where('id', $data['id'])->first();
        $storeid  =  $emstore->getId();
        $location = Location::where('STLO_STOREID', $storeid)->first();
        
        $storeTimeZone = $emstore->getTimeZone();

        $origin = [
            "address1" => $location->getAddress1(),
            "address2" => $location->getAddress2(),
            "city"     => $location->getCity(),
            "zip"      => $location->getPostCode(),
        ];
        $originAddress = $this->addressFormat($origin);

        if (!is_null($settings) && ($settings->getMethodTitle() == $methodTitle ) && ( is_null($orders) || $resend) ) {
            if(!$resend){
                $orders = new Order;
                $orders->id = $data['id'];
                $orders->created_at = Carbon::now($storeTimeZone);
            }
            $orders->job_status = "Pendiente";
            $orders->store_id = $emstore->getId();
            $orders->name = $data['name'];
            $orders->number = $data['number'];
            $orders->order_number = substr($data['name'], 1, strlen($data['name']));
            $orders->currency = $data['currency'];
            $orders->shipping_method = $data['shipping_lines'][0]['title'];
            $orders->financial_status = $data['financial_status'];
            $orders->customer = $data['customer']['first_name'] . " " . $data['customer']['last_name'];
            $orders->shipping_address = $shipping_address;
            $orders->order_status_url = $data['order_status_url'];
            $orders->save();

            $server = $settings->getServer();
            $api_client_id = $settings->getServientregaApi();
            $api_client_secret = $settings->getServientregaSecret();
            $api_client_billing_code = $settings->getServientregaBillingCode();
            
            $packageInfo = $this->setInfoPackage($data, $shipping_address, $shippingInformation, $email, $origin, $fechaDeseada);

            $servientrega = new SoapController($server, $api_client_id, $api_client_secret, $api_client_billing_code, $domain);
            $guia = $servientrega->CargueMasivoExterno($packageInfo);

            if ($guia->CargueMasivoExternoResult){
                $guide_number = $guia->envios->CargueMasivoExternoDTO->objEnvios->EnviosExterno->Num_Guia;
                $orders = Order::where('id', $data['id'])->first();
                $orders->shipping_id = $guide_number;
                $orders->job_status = "Finished";
                $orders->save();

                $servientrega->generate_stickers($guide_number);

                if($email){
                    $cEmail = new EmailController();
                    $cEmail->sendEmail($email, $guide_number, "sin mensaje");
                }
                return [ 'success' => true ];
            }else{
                $orders = Order::where('id', $data['id'])->first();
                $orders->job_status = "Error";
                $orders->save();
                return [ 'success' => false , "guia" => $guia ];
            }

        }
    }
    
    public function servientregarecoleccion(Request $request){
        //formato(YYYY-MM-dd)
        //String(HH:mm)
        $data = $request->all();
        $guide_number = $request['guide_number'];
        $pickupDate   = "2020-09-04";
        $pickUpHour   = "09:30";
        $comments     = "sin comentarios";

        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();

        $store = new Store;
        $emstore = $store->findByDomain($domain);
        $settings = Setting::findByStoreId($emstore->getId());

        $server = $settings->getServer();
        $api_client_id = $settings->getServientregaApi();
        $api_client_secret = $settings->getServientregaSecret();
        $api_client_billing_code = $settings->getServientregaBillingCode();

        $servientrega = new SoapController($server, $api_client_id, $api_client_secret, $api_client_billing_code, $domain);
        $guia = $servientrega->CreateRequestSporadic($guide_number, $pickupDate, $pickUpHour, $comments);
        
    }
    
    public function cancel(Request $request){
        $data = $request->All();
        $guide_number = $data['guide_number'];
        $order_id = $data['order_id'];

        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json')['body']['shop'];

        $store = new Store;
        $emstore = $store->findByDomain($domain);
        $settings = Setting::findByStoreId($emstore->getId());

        $servientrega = $this->initServientrega($settings, $domain);
        $response = $servientrega->cancel_order($guide_number, $order_id);

        if($response->interno->ResultadoAnulacionGuias->Descripcion == "Operacion ejecutada exitosamente"){
            $orders = Order::where('id', $order_id)->first();
            $orders->job_status = "Canceled";
            $orders->save();

            app('translator')->setLocale($settings->getLanguage());
            $request->session()->flash('success', __('servientrega.orderdetail.cancel.success'));
        }
        else{
            app('translator')->setLocale($settings->getLanguage());
            Log::error("OrderController->cancel : ", [$response->interno->ResultadoAnulacionGuias->Descripcion]);
            $request->session()->flash('myerror', __('servientrega.orderdetail.cancel.fail'). substr($response->interno->ResultadoAnulacionGuias->Descripcion, 0, 49 ));
        }
        return redirect()->route('orders');
    }

    public function setInfoPackage($data, $shipping_address, $shippingInformation, $email, $origin, $fechaDeseada){
        $infoItems = $this->getInfoItems($data['line_items']);
        $item_quantity = $this->get_quantity_product($data['line_items']);
        $city = $this->clean_city($shippingInformation['city']);
        $des_departamento = $shippingInformation['province'];
        $arrayDetalleProductos = [];

        // $rem_departamento = $this->clean_city($origin['province']);
        $description = "";
        foreach ($data['line_items'] as $key => $item) {
            $description .=  "{$item['title']}, ";
        }

        $packageInfo = [
            "id_order"        => $data['id'],
            "num_piezas"      => $item_quantity,
            "peso_total"      => $infoItems['peso'],
            "valor_declarado" => $infoItems['valor_declarado'],
            "descripcion"     => $description,
            "alto"            => $infoItems['alto'],
            "ancho"           => $infoItems['ancho'],
            "largo"           => $infoItems['largo'],
            "fechaDeseada"    => "fecha de entrega deseada: {$fechaDeseada}",
            "destinatario"    => [
                "telefono"     => "",
                "ciudad"       => $city,
                "direccion"    => $shipping_address,
                "departamento" => $des_departamento,
                "nombre"       => "{$shippingInformation['first_name']} {$shippingInformation['last_name']}",
                "email"        => $email,
            ],
            "remitente"    => [
                "telefono"     => $data['phone'],
                "cp" => $origin['zip'],
                "city" => $origin['city'],
            ],
            "EnviosUnidadEmpaqueCargue" => $infoItems['EnviosUnidadEmpaqueCargue'],
        ];

        return $packageInfo;
    }

    public function see_pdf_stickers($guide_number){
        $path = public_path("/stickers/");
        return response()->file("{$path}$guide_number.pdf");
    }

    public function getInfoItems($items){
        $weight = 0;
        $height = 0;
        $width  = 0;
        $length = 0;
        $valor_declarado  = 0;
        $total_min_shipping = 5000;
        $itemsinfo = [
            "peso"  => 0,
            "largo" => 0,
            "alto"  => 0,
            "ancho" => 0,
            "valor_declarado" => 0,
            "EnviosUnidadEmpaqueCargue" => []
        ];

        foreach ( $items as $key => $item) {
            $weight          =  ($item['grams'] * $item['quantity'] )/1000;
            $valor_declarado =  ($item['quantity'] * $item['price'] );

            $weight = ($weight < 1)? 1/$item['quantity'] : $item['grams']/1000;
            $valor_declarado = ($valor_declarado < $total_min_shipping)? $total_min_shipping/$item['quantity'] : $item['price'];

            $id_product = $item['product_id'];
            $itemsinfo['peso'] = $itemsinfo['peso'] + $weight;
            try{
                $dimensiones= Productmetadata::where('PROD_PRODUCT',$id_product)->where('PROD_METADATA_KEY','dimensions')->first()['PROD_METADATA_VALUE'];
                if($dimensiones != null){
                    $dimensions = explode("x", $dimensiones);
                    $height = (int)$dimensions[0];
                    $length = (int)$dimensions[1];
                    $width  = (int)$dimensions[2];
                }
                else{
                    $height = 1;
                    $length = 1;
                    $width  = 1;
                }
                for($i=0; $i < $item['quantity']; $i++){
                    $itemsinfo['valor_declarado'] = $itemsinfo['valor_declarado'] + $valor_declarado;
                    
                    $itemDimensions = array(
                        "Num_Peso"  => $weight,
                        "Num_Largo" => $length < 1 ? 1: $length,
                        "Num_Ancho" => $width  < 1 ? 1: $width,
                        "Num_Alto"  => $height < 1 ? 1: $height,
                        "Num_Distribuidor"   => 1,
                        'Ide_UnidadEmpaque'  => "00000000-0000-0000-0000-000000000000",
                        'Ide_Envio'          => "00000000-0000-0000-0000-000000000000",
                        "Fec_Actualizacion"  => Carbon::now()->toDateString(),
                        "Num_Consecutivo"    => 1,
                        "Des_IdArchivoOrigen"=> 1,
                        "Des_DiceContener"   => $item["title"],
                        "Num_Cantidad"       => 1,
                        "Num_ValorDeclarado" => $valor_declarado,
                        "Nom_UnidadEmpaque"  => "GENERICA",
                        "Des_UnidadLongitud" => "cm",
                        "Des_UnidadPeso"     => "kg"
                    );
                    array_push($itemsinfo["EnviosUnidadEmpaqueCargue"], $itemDimensions);
                }
            }
            catch(Exception $e){
            }
        }
        if($itemsinfo['valor_declarado'] < $total_min_shipping){
            $itemsinfo['valor_declarado']  = $total_min_shipping;
        }
        return $itemsinfo;
    }

    public function get_quantity_product($items){
        $item_quantity = 0;
        foreach ($items as $key => $item)
            $item_quantity += $item['quantity'];
        return $item_quantity;
    }

    public static function clean_city($city){
        return $city == 'Bogotá, D.C.' ? 'Bogota' : $city;
    }

    public function addressFormat($data){
        $address1 = $data['address1'];
        $city = $data['city'];
        $zip = $data['zip'];

        $complet_address = "{$address1}, {$zip} {$city}";
        return $complet_address;
    }

    public function defLanguage($settings, $shopApi){
        if (is_null($settings)) {
            $default_lang = UStore::DefLang($shopApi);
            $settings = new Setting();
            $settings->setLanguage($default_lang);
        }
        app('translator')->setLocale($settings->getLanguage());
    }

    public function initServientrega($settings, $domain, $tracking=false){
        $server = $settings->getServer();
        $api_client_id = $settings->getServientregaApi();
        $api_client_secret = $settings->getServientregaSecret();
        $api_client_billing_code = $settings->getServientregaBillingCode();
    
        $servientrega = new SoapController($server, $api_client_id, $api_client_secret, $api_client_billing_code, $domain, $tracking);
        return $servientrega;
    }

}
