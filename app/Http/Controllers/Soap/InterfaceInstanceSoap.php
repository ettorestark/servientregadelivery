<?php
namespace App\Http\Controllers\Soap;

interface InterfaceInstanceSoap
{
    public static function init($api_client_id, $api_client_secret, $codFacturacion, $namePack, $withAuthentication);
}