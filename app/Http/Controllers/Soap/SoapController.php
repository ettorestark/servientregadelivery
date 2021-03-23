<?php

namespace App\Http\Controllers\Soap;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Servientrega\ServientregaCotizadorController;
use SoapClient;

class SoapController extends BaseSoapController
{
    public $service;
    public $token = null;
    public $billing_code = null;
    private $servientregaController;
    private $user;

    function __construct($server, $api_client_id="", $api_client_secret="", $codFacturacion="", $namePack="", $tracking=false, $headers=true) {
        if($server == "Test"){
            if($tracking == false){
                self::setWsdl('http://190.131.194.159:8059/GeneracionGuias.asmx?WSDL');
            }
            else{
                self::setWsdl('http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?WSDL');
            }
        }
        else{
            if($tracking == false){
                self::setWsdl('http://web.servientrega.com:8059/GeneracionGuias.asmx?WSDL');
            }
            else{
                self::setWsdl('http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?WSDL');
            }
        }
        if($headers){
            $this->service = InstanceSoapClient::init($api_client_id, $api_client_secret, $codFacturacion, $namePack);
            $this->billing_code = $codFacturacion;
            $this->user = $api_client_id;
            
            $this->servientregaController = new ServientregaCotizadorController($server, $api_client_id, $api_client_secret, $codFacturacion);
            $this->token =  $this->servientregaController->token;
        }
        else{
            $this->service = InstanceSoapClient::init($api_client_id, $api_client_secret, $codFacturacion, $namePack, $withAuthentication=false);
        }
       
    }
    
    public function CargueMasivoExterno($infoPackage)
    {
        $params = [
            'Num_Guia' => 0,
            'Num_Sobreporte' => 0,
            'Num_Piezas' => $infoPackage['num_piezas'],
            'Des_TipoTrayecto' => 1, //nacional 2 internacional
            // 'Ide_Producto' => (int)$instance->servientrega_product_type, //mercancia premier
            'Ide_Producto' => 6, //mercancia premier
            'Ide_Destinatarios' => '00000000-0000-0000-0000-000000000000',
            'Ide_Manifiesto' => '00000000-0000-0000-0000-000000000000',
            // 'Des_FormaPago' => $instance->way_pay, // 2 Crédito 4 contra entrega
            'Des_FormaPago' => '2', // 2 Crédito 4 contra entrega
            'Des_MedioTransporte' => 1, // terrestre
            'Num_PesoTotal' => $infoPackage['peso_total'],
            'Num_ValorDeclaradoTotal' => $infoPackage['valor_declarado'],
            'Num_VolumenTotal' => 0, // para que se calcule
            'Num_BolsaSeguridad' => 0, //solo para valores, de lo contrario 0
            'Num_Precinto' => 0,
            'Des_TipoDuracionTrayecto' => 1, //1 normal
            'Des_Telefono' => $infoPackage['destinatario']['telefono'],
            // 'Des_DepartamentoDestino' => $destination_state_name,
            'Des_Ciudad' => $infoPackage['destinatario']['ciudad'],
            'Des_Direccion' => $infoPackage['destinatario']['direccion'],
            'Nom_Contacto' => $infoPackage['destinatario']['nombre'],
            'Num_ValorLiquidado' => 0, //calculado por el sistem 0 para todos los casos
            'Des_DiceContener' => 'Burrito chicken',//substr($infoPackage['descripcion'], 0, 50),// el contenido del envío
            'Des_TipoGuia' => 1,
            'Num_VlrSobreflete' => 0,
            'Num_VlrFlete' => 0,
            'Num_Descuento' => 0,
            'Num_PesoFacturado' => 0,
            'idePaisOrigen' => 1, // 1 Colombia
            'idePaisDestino' => 1, // 1 Colombia
            'Des_IdArchivoOrigen' => 1, // para tos los casos
            'Des_DepartamentoDestino'=> $infoPackage['destinatario']['departamento'],
            // 'Des_DepartamentoOrigen' => $infoPackage['remitente']['departamento'],
            'Num_TelefonoRemitente'  => $infoPackage['remitente']['telefono'],
            'Rem_codigopostal' => $infoPackage['remitente']['cp'],
            'Des_CiudadRemitente' => $this->servientregaController->getDaneCode( $infoPackage['remitente']['city'] ),
            'Est_CanalMayorista' => false,
            'Num_IdentiRemitente' => '',
            'Num_Alto' => $infoPackage['alto'],
            'Num_Ancho' => $infoPackage['ancho'],
            'Num_Largo' => $infoPackage['largo'],
            'Gen_Cajaporte' => 0,
            'Gen_Sobreporte' => 0,
            'Nom_UnidadEmpaque' => 'GENERICA',
            'Des_UnidadLongitud' => 'cm',
            'Des_UnidadPeso' => 'kg',
            'Num_ValorDeclaradoSobreTotal' => 0,
            'Num_Factura' => $infoPackage['id_order'],
            'Des_CorreoElectronico' => $infoPackage['destinatario']['email'],
            'Num_Recaudo' => 0,
            'Des_VlrCampoPersonalizado1' => substr($infoPackage['fechaDeseada'], 0, 60),
            'objEnviosUnidadEmpaqueCargue' =>
                [
                    'EnviosUnidadEmpaqueCargue' => $infoPackage['EnviosUnidadEmpaqueCargue']
                ],
            'Est_EnviarCorreo' => false,
        ];

        $body = [
            'envios' => [
                'CargueMasivoExternoDTO' => [
                    'objEnvios' => [
                        'EnviosExterno' => $params
                    ]
                ]
            ]
        ];
        $resp = $this->service->CargueMasivoExterno($body);
        return $resp;
    }

    public function generate_stickers($guide_number)
    {
        $params = [
            'num_Guia' => $guide_number,
            'num_GuiaFinal' => $guide_number,
            'sFormatoImpresionGuia' => 2,
            'Id_ArchivoCargar' => '0',
            'interno' => false
        ];

        $sticker = array();
        $body = array_merge($params, [
            'ide_CodFacturacion' => $this->billing_code
        ]);

        try{
            $sticker = $this->service->GenerarGuiaSticker($body);
        }catch (\Exception $exception){
        }
        $path = public_path("/stickers/");
        $sticker_file = file_put_contents("{$path}$guide_number.pdf", $sticker->bytesReport);
    }

    public function cancel_order($guide_number){
        $body = [
            "num_Guia"      => $guide_number,
            "num_GuiaFinal" => $guide_number
        ];
        $response = $this->service->AnularGuias($body);
        return $response;
    }

    public function estado_guia($guide_number){
        $body = [
            "ID_Cliente" => 19379008,
            "guia" => $guide_number
        ];
        $response = $this->service->EstadoGuia($body);
        return $response;
    }

    public function consultar_guia($guide_number){
        $body = [
            "NumeroGuia" => $guide_number
        ];
        $response = $this->service->ConsultarGuia($body);
        return $response;
    }
    
    public function Consultar_guia_externo($guide_number){
        $body = [
            "NumeroGuia" => $guide_number
        ];
        $response = $this->service->ConsultarGuiaExterno($body);
        return $response;
    }

    public function encriptar_contrasena($pwd){
        $body = [
            "strcontrasena" => $pwd
        ];
        $response = $this->service->EncriptarContrasena($body);
        return $response;
    }

    public function desencriptar_contrasena($pwd){
        $body = [
            "strcontrasenaEncriptada" => $pwd
        ];
        $response = $this->service->DesencriptarContrasena($body);
        return $response;
    }
    
    public function CreateRequestSporadic($guide_number, $pickupDate, $pickUpHour, $comments){
        //formato(YYYY-MM-dd)
        //String(HH:mm)
        $body = [
            "lstGuides"  => $guide_number,
            "pickUpDate" => $pickupDate,
            "pickUpHour" => $pickUpHour,
            "comment"    => $comments
        ];
        $response = $this->service->CreateRequestSporadic($body);
        return $response;
    }

    public function getValidTimePickUp($idCountry=1, $idCity, $idProduct, $idSubProduct, $DayPickUp, $idTime){
        $body = [
            "idCountry"     => $idCountry,
            "idCity"        => $idCity,
            "idProduct"     => $idProduct,
            "idSubProduct"  => $idSubProduct,
            "DayPickUp"     => $DayPickUp,
            "idTime"        => $idTime,
        ];
        $response = $this->service->getValidTimePickUp($body);
        return $response;
    }

    public function GetDetailPickUp($documentPickUp){
        $body = [
            "DocumentPickUp"  => $documentPickUp
        ];
        $response = $this->service->GetDetailPickUp($body);
        return $response;
    }

    public function CancelPickUp($documentPickUp){
        $body = [
            "DocumentPickUp"  => $documentPickUp
        ];
        $response = $this->service->CancelPickUp($body);
        return $response;
    }
    
}