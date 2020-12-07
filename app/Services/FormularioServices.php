<?php
namespace App\Services;

use App\Entidades\Formulario;
use App\Entidades\FormularioActa;
use DB;
use Log;
use Exception;
use Session;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-12-01
 */
class FormularioServices {

    public function __construct()  {        }

    public static function formularioHoy()
    {
        $fechahoy= date('Y-m-d 00:00:00');                    
        $formhoy=Formulario::where([['n_idusuario', '=', Session::get('userUPB')->n_idusuario],['created_at', '>', $fechahoy],['t_activo', '=', "SI"],])->first();
        return $formhoy;
    }

    public static function getFormularioHoy()
    {
        $fechahoy = date('d/m/Y');
        $sql = "select * from formulario where n_idusuario = :n_idusuario and trunc(created_at) = to_date(:created_at,'dd/mm/yyyy') and t_activo ='SI'";
        $formhoy = collect(DB::select($sql, ['n_idusuario'=>$request->n_idusuario,'created_at'=>$fechahoy]))->first();        
        return $formhoy;
    }

    public static function getFormularioEncuestaHoy()
    {
        $fechahoy= date('Y-m-d 00:00:00');                    
        $formhoy=Formulario::where([['n_idusuario', '=', Session::get('idUsuario')],['created_at', '>', $fechahoy],['t_activo', '=', "SI"],])->first();
        //dd(Session::get('idUsuario'));
        return $formhoy;
    }


    public static function getActaCovid()
    {     
        $formhoy=FormularioActa::where([['n_idusuario', '=', Session::get('idUsuario')],['t_activo', '=', "SI"],])->first();
        //$formhoy=new Formulario();
        //$formhoy=null;
        return $formhoy;
    }

    public static function getActaCovidUsuario($idUsuario)
    {     
        $formhoy=FormularioActa::where([['n_idusuario', '=',$idUsuario],['t_activo', '=', "SI"],])->first();
        //$formhoy=new Formulario();
        //$formhoy=null;
        return $formhoy;
    }

    

}