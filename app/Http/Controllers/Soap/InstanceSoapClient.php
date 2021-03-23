<?php

namespace App\Http\Controllers\Soap;
use SoapClient;

use Illuminate\Http\Request;


class InstanceSoapClient extends BaseSoapController implements InterfaceInstanceSoap
{
    const URL_GUIDES = 'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl';
    const NAMESPACE_GUIDES = 'http://tempuri.org/';

    public static function init($api_client_id, $api_client_secret, $codFacturacion, $namePack, $withAuthentication=True){
        $wsdlUrl = self::getWsdl();

        $headerData = self::paramsHeader($api_client_id, $api_client_secret, $codFacturacion, $namePack);
        $client = new \SoapClient($wsdlUrl, self::optionsSoap());
        if($withAuthentication){
            $header = new \SoapHeader(self::NAMESPACE_GUIDES, 'AuthHeader', $headerData);
            $client->__setSoapHeaders($header);
        }

        return $client;
    }

    private static function optionsSoap()
    {
        return [
            "trace" => true,
            "soap_version"  => SOAP_1_2,
            "connection_timeout"=> 60,
            "encoding"=> "utf-8",
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ]),
            'cache_wsdl' => WSDL_CACHE_NONE
        ];
    }

    private static function paramsHeader($api_client_id, $api_client_secret, $codFacturacion, $namePack)
    {
        return [
            'login' => $api_client_id,
            'pwd' => $api_client_secret,
            'Id_CodFacturacion' => $codFacturacion,
            'Nombre_Cargue' => $namePack
        ];
    }



}


