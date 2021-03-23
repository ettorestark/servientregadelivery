<?php

namespace App\Http\Controllers\Servientrega;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Vexsolutions\Helpers\UStore;
use App\Vexsolutions\Helpers\Texts;
use App\Models\Productmetadata;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Store;
use Carbon\Carbon;
use Log;

use Illuminate\Support\Facades\Http;

class ServientregaCotizadorController extends Controller
{
    private $httpClient;
    public $token = null;


    function __construct($server, $api_client_id, $api_client_secret, $codFacturacion) {
        if($server == "Test"){
            $this->httpClient = 'http://190.131.194.159:8058/CotizadorCorporativo/api';
        }
        else{
            $this->httpClient = 'http://web.servientrega.com:8058/cotizadorcorporativo/api';
        }
        $body = [
            "login" => "{$api_client_id}",
            "password"=>"{$api_client_secret}",
            "codFacturacion"=>"{$codFacturacion}"
        ];

        $response = $this->post_body($body, '/autenticacion/login');
        
        if( $response->successful() ){
            $this->token = $response->json()['token'];
        }
        
    }

    public function getPricing($pickupCity, $deliveryCity, $orderInfo){
        $pickupCitydaneCode   = $this->getDaneCode($pickupCity);
        $deliveryCitydaneCode = $this->getDaneCode($deliveryCity);
        $body = [
            "ValorDeclarado"      => $orderInfo['totalPrice'],
            "IdDaneCiudadOrigen"  => $pickupCitydaneCode,
            "IdDaneCiudadDestino" => $deliveryCitydaneCode,
            "EnvioConCobro"       => false,
            "FormaPago"           => 2,
            "TiempoEntrega"       => 1,
            "MedioTransporte"     => 1, // terrestre
            "NumRecaudo"          => 123
        ];

        $itemsInfo = $this->getInfoItems($orderInfo);
        $body = array_merge($itemsInfo, $body);

        if($this->token != null){
            $response = $this->post_body($body, '/Cotizacion');
            $json =  $response->json();
            if($response->successful()){
                return ["validate" => true, "price" => $response->json()['ValorTotal'], "currency" => 'COP'];
            }
        }
        return ["validate" => false];
    }

    public function getInfoItems($orderInfo){
        $weight = 0;
        $height = 0;
        $width  = 0;
        $length = 0;
        $numPiezas = 0;
        $itemsArray = [ 
            "IdProducto" => 6,
            "NumeroPiezas" => 1,
            "Piezas" => []
        ];
        foreach ( $orderInfo['items'] as $key => $item) {
            $weight = ($item['grams'] * $item['quantity'] )/1000;
            if($weight < 1 ){
                $weight = 1 / $item['quantity'];
            }
            else{
                $weight = $item['grams']/1000;
            }
            $id_product = $item['product_id'];
            $numPiezas += $item['quantity'];
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
                    $itemDimensions = array(
                    "Peso"  => $weight,
                    "Alto"  => $height < 1 ? 1: $height,
                    "Largo" => $length < 1 ? 1: $length,
                    "Ancho" => $width  < 1 ? 1: $width,
                    );
                    array_push($itemsArray["Piezas"], $itemDimensions);
                }
                
            }
            catch(Exception $e){
            }
        }
        $itemsArray["NumeroPiezas"] = $numPiezas;
        return $itemsArray;
    }

    public function getDaneCode($city){
        $texts = new Texts();
        $city =  strtoupper( $texts->eliminar_Acentos($city) );
        $daneCodes = [
            ["code"=>'63001000',"departamento"=>'QUINDIO',"municipio"=>'ARMENIA'],
            ["code"=>'41001000',"departamento"=>'HUILA',"municipio"=>'NEIVA'],
            ["code"=>'11001000',"departamento"=>'BOGOTA' ,"municipio"=>'BOGOTA'],
            ["code"=>'76001000',"departamento"=>'VALLE',"municipio"=>'CALI'],
            ["code"=>'66001000',"departamento"=>'RISARALDA',"municipio"=>'PEREIRA'],
            ["code"=>'25754000',"departamento"=>'CUNDINAMARCA',"municipio"=>'SOACHA'],
            ["code"=>'50001000',"departamento"=>'META',"municipio"=>'VILLAVICENCIO'],
            ["code"=>'76111000',"departamento"=>'VALLE',"municipio"=>'BUGA'],
            ["code"=>'73001000',"departamento"=>'TOLIMA',"municipio"=>'IBAGUE'],
            ["code"=>'19001000',"departamento"=>'CAUCA',"municipio"=>'POPAYAN'],
            ["code"=>'76520000',"departamento"=>'VALLE',"municipio"=>'PALMIRA'],
            ["code"=>'66170000',"departamento"=>'RISARALDA',"municipio"=>'DOSQUEBRADAS'],
            ["code"=>'73268000',"departamento"=>'TOLIMA',"municipio"=>'ESPINAL'],
            ["code"=>'15238000',"departamento"=>'BOYACÁ',"municipio"=>'DUITAMA'],
            ["code"=>'25899000',"departamento"=>'CUNDINAMARCA',"municipio"=>'ZIPAQUIRA'],
            ["code"=>'25269000',"departamento"=>'CUNDINAMARCA',"municipio"=>'FACATATIVA'],
            ["code"=>'25430000',"departamento"=>'CUNDINAMARCA',"municipio"=>'MADRID'],
            ["code"=>'52001001',"departamento"=>'NARIÑO',"municipio"=>'IPIALES'],
            ["code"=>'50573000',"departamento"=>'META',"municipio"=>'PUERTO LOPEZ'],
            ["code"=>'50006000',"departamento"=>'META',"municipio"=>'ACACIAS'],
            ["code"=>'73168000',"departamento"=>'TOLIMA',"municipio"=>'CHAPARRAL'],
            ["code"=>'25175000',"departamento"=>'CUNDINAMARCA',"municipio"=>'CHIA'],
            ["code"=>'63130000',"departamento"=>'QUINDÍO',"municipio"=>'CALARCA'],
            ["code"=>'73408000',"departamento"=>'TOLIMA',"municipio"=>'LERIDA'],
            ["code"=>'15176000',"departamento"=>'BOYACÁ',"municipio"=>'CHIQUINQUIRA'],
            ["code"=>'25290000',"departamento"=>'CUNDINAMARCA',"municipio"=>'FUSAGASUGA'],
            ["code"=>'73443000',"departamento"=>'TOLIMA',"municipio"=>'MARIQUITA'],
            ["code"=>'73349000',"departamento"=>'TOLIMA',"municipio"=>'HONDA'],
            ["code"=>'19698000',"departamento"=>'CAUCA',"municipio"=>'SANTANDER DE QUILICHAO'],
            ["code"=>'76834000',"departamento"=>'VALLE',"municipio"=>'TULUA'],
            ["code"=>'17174000',"departamento"=>'CALDAS',"municipio"=>'CHINCHINA'],
            ["code"=>'25307000',"departamento"=>'CUNDINAMARCA',"municipio"=>'GIRARDOT' ],
        ];
        $municipios = array_column($daneCodes, 'municipio');
        $found_key = array_search($city, $municipios);
        return $daneCodes[$found_key]['code'];
    }

    public function post_body($body, $url){
        if($this->token!= null){
            $response = Http::withBody( json_encode($body), 'application/json')
                            ->withToken($this->token)
                            ->post("{$this->httpClient}{$url}");
            return $response;
        }

        $response = Http::withBody( 
            json_encode($body), 'application/json'
        )->post("{$this->httpClient}{$url}");

        return $response;
    }
}