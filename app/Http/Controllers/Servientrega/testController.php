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
use App\Http\Controllers\Servientrega\ServientregaCotizadorController;
use App\Http\Controllers\Soap\SoapController;
use Illuminate\Support\Facades\Http;

class testController extends Controller
{
    public $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IkxVSVMxOTM3IiwianRpIjoiY2NiZWU1NDYtZTU5ZC00YjEzLWFiNGQtMWU1NzRhYTU4YTg0IiwibG9naW4iOiJMVUlTMTkzNyIsImNvZGlnb2ZhY3R1cmFjaW9uIjoiU0VSNDA4IiwiaWRjbGllbnRlIjoiMTkzNzkwMDggICAgICAgICAgICAiLCJleHAiOjE1OTg0NTE1OTMsImlzcyI6IkNvdGl6YWRvckNvcnBvcmF0aXZvIiwiYXVkIjoic2VydmllbnRyZWdhLmNvbS5jbyJ9.gSKbTtEdKfHZZaR4Rgda_yOCYPYUF6vtTf484HOnsAE";
    public $user  = "Luis1937";
    public $pwd   = "MZR0zNqnI/KplFlYXiFk7m8/G/Iqxb3O";
    public $codigo= "SER408";
    public $server= "Test";

    public function consultarIde(){
        $servientrega = new SoapController($this->server, $this->user, $this->pwd, $this->codigo, "hola");
        $body = [
            'ideEnvio' => 0,
            'Ide_CodFacturacion' => $this->codigo
        ];
        $response = $servientrega->service->CrearUnidadesEmpaqueBlanco($body);
        dd($response);
    }

    public function test(){
        $servientrega = new ServientregaCotizadorController($this->server, $this->user, $this->pwd, $this->codigo);
        $orderInfo['totalPrice'] = 5000;
        $response = $this->getPricingTest("BARRANQUILLA", "Bogota", $orderInfo, $servientrega);
        dd($response);
    }

    public function getPricingTest($pickupCity, $deliveryCity, $orderInfo, $servientrega){
        $pickupCitydaneCode   = $servientrega->getDaneCode($pickupCity);
        $deliveryCitydaneCode = $servientrega->getDaneCode($deliveryCity);
        
        $body = [
            "IdProducto" => 6,
            "NumeroPiezas" => 2,
            "Piezas" => [
                [
                    "Peso" => 6,
                    "Largo"=> 1,
                    "Ancho"=> 1,
                    "Alto" => 1,
                    "Num_Cantidad" => 1
                ],
                [
                    "Peso" => 2,
                    "Largo"=> 2,
                    "Ancho"=> 3,
                    "Alto" => 1,
                    "Num_Cantidad" => 2
                ]
            ],
            "ValorDeclarado"      => 5000,
            "IdDaneCiudadOrigen"  => $pickupCitydaneCode,
            "IdDaneCiudadDestino" => $deliveryCitydaneCode,
            "EnvioConCobro"       => false,
            "FormaPago"           => 2,
            "TiempoEntrega"       => 1,
            "MedioTransporte"     => 1,// terrestre
            "NumRecaudo"          => 123456
        ];

        if($this->token != null){
            $response = $servientrega->post_body($body, '/Cotizacion');
            return $response->json();
            if($response->successful()){
                return ["validate" => true, "price" => $response->json()['ValorTotal'], "currency" => 'COP'];
            }
            return $response;
        }
    }
}