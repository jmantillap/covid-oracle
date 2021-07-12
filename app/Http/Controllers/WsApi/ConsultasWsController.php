<?php

namespace App\Http\Controllers\WsApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Log;
use Config;

class ConsultasWsController extends Controller
{
    
    public function getFormularioDiario($documento)
    {             
        $validator = Validator::make(array('documento'=>$documento),$this->reglasActualizar(),$this->mensajes());        
        if ($validator->fails()){ return response()->json(array('status' => 'ERROR','message' =>$validator->messages())); }
        $sql="SELECT 'OK' ESTADO,F.N_IDFORMULARIO,f.N_SEMAFORO
              FROM formulario f inner join users u on (f.N_IDUSUARIO=u.N_IDUSUARIO)
              WHERE f.T_ACTIVO='SI' and trunc(f.created_at)=trunc(sysdate)
              and u.T_DOCUMENTO=:NUMERO_DOCUMENTO and u.T_ACTIVO='SI'  AND rownum=1";

        $registro = collect(DB::select($sql,['NUMERO_DOCUMENTO' => $documento]))->first();
        $response=array('status'=>'ERROR','message'=>'No ha llenado el formulario el día de hoy para el documento:'. $documento);
        if(!is_null($registro)){            
            if($registro->n_semaforo==1){
                $response=array('status'=>$registro->estado,'message'=>'Aprobado el ingreso para el documento:'. $documento);
            }else{
                $response=array('status'=>'ERROR','message'=>'Tiene Bloqueo de ingreso para el documento:'. $documento);
            }
        }//dd($_SERVER['REMOTE_ADDR']);
        //Log::channel('ws')->info('Consulta desde IP-->'.$_SERVER['REMOTE_ADDR']);            
        return response()->json($response);   
    }

    private function reglasActualizar()
    {
        return  $rules=['documento' => 'required'];        
    }
    private function mensajes()
    {
        return $custom=['documento.required'=>'El documento es requerido',];
    }
}
