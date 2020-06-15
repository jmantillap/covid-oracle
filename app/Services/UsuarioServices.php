<?php
namespace App\Services;
use App\Entidades\Administrador;
use DB;
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class UsuarioServices {

    public function __construct()  {        
    }

    public function actualizarPassword($id,$nuevaClave){
        $administradorActualizar=Administrador::find($id);
        $administradorActualizar->t_password=$nuevaClave;        
        $administradorActualizar->save();
    }

    // public static function correoPersonaUsuario($idUsuario){
    // 	$persona=Persona::Where(DB::raw("LTRIM(RTRIM(CODPER))"), $idUsuario)->first();
    // 	if($persona!=null and $persona->E_MAIL!=null){
    // 	    return $persona->E_MAIL;
    // 	}else{
    // 		return null;
    // 	}
    //
    // }

}
