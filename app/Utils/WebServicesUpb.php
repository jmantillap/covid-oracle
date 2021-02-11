<?php
namespace App\Utils;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;
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
            'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json','passwordldap' =>$password,],
            'query' => ['id' => $idBanner],
            'verify' => false,
            'connect_timeout' => 10,
            'timeout' => 10,
        ];  //'connect_timeout' => Config::get('ws.connect_timeout'), //'timeout' => Config::get('ws.timeout'),
        try {
            //Log::channel('ws')->info('Inicio Prueba');            
            $response = $client->request('GET', "/General/Autenticacion2/?",$parametros);        
            $data = json_decode($response->getBody());
            unset($response, $client);    
        } catch(ClientException $e) {
            return self::mensajeError($e,"001");
        } catch (ServerException $e){
            return self::mensajeError($e,"002");
        } catch (BadResponseException $e){    
            return self::mensajeError($e,"003");
        } catch (ConnectException $e){    
            return self::mensajeError($e,"004");
        } catch (RequestException $e){                    
            return self::mensajeError($e,"005");
        } catch (GuzzleException $e){            
            return self::mensajeError($e,"006");
        } catch (Exception $e) { //Log::error("En el Archivo: ".$e->getFile()); //Log::error("En la linea: ".$e->getLine()); //Log::error("En la linea: ".$e->getMessage());             
            Log::error($e);  
            return json_decode('{"ESTADO":"*** ERROR AL AUTENTICAR **** Contacte Con el Administrador del sistema o Intente nuevamente Por favor"}');
        }  
        return $data;
    }

    private static function mensajeError($error,$codigo="000" ){
        //Log::error($e); return json_decode('{"ESTADO":"*** ERROR AL AUTENTICAR **** INTENTE NUEVAMENTE LA AUTENTICACION POR FAVOR COD.ERROR.006"}');
        Log::error($error);
        $mensaje="*** ERROR AL AUTENTICAR **** INTENTE NUEVAMENTE LA AUTENTICACION POR FAVOR COD.ERROR.".$codigo;  
        return json_decode('{"ESTADO":"'.$mensaje.'"}');
    }

    public static function isExisteLdap($pidmCeros)
    {
        $client = new Client(['base_uri' => Config::get('ws.endpoint')]);
        $parametros=[
            'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',],
            'query' => ['id' => $pidmCeros],
            'verify' => false,
        ];  
        $data=null;
        try {    
            $response = $client->request('GET', "/General/UsuariosLdap/?",$parametros);        
            $data = json_decode($response->getBody());
            unset($response,$client);
        } catch (Exception $e) {
             Log::error($e);             
            return json_decode('{"ESTADO":"*** ERROR GRAVE AL AUTENTICAR **** Contacte Con el Administrador del sistema"}');
        }  
        return $data;
    }



    

}