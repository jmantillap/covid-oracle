<?php
namespace App\Utils;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Log;
use Exception;
use Config;

class WebServicesUpb {

    //private static $baseUrl;
    //private static $client;


    public function __construct()  {
        //$this->baseUrl=Config::get('ws.endpoint');
    }

    /* private  static function getBaseUrl()
    {
        return $self::$baseUrl=Config::get('ws.endpoint');
    } */

    public static function getAutenticacion($idBanner,$password)
    {
        $client = new Client(['base_uri' => Config::get('ws.endpoint')]);
        $parametros=[
            'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',],
            'query' => ['id' => $idBanner,'password' => $password],
            'verify' => false,
        ];  
        try {
            $response = $client->request('GET', "/General/Autenticacion/?",$parametros);        
            $data = json_decode($response->getBody());            
        } catch (Exception $e) {
             Log::error($e);             
            return json_decode('{"ESTADO":"*** ERROR GRAVE AL AUTENTICAR **** Contacte Con el Administrador del sistema"}');
        }  
        return $data;
    }




    

}