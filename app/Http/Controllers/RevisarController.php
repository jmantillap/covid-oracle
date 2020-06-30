<?php

namespace App\Http\Controllers;

use App\Entidades\Formulario;
use App\Entidades\Sedes;
use App\Services\BannerServices;
use App\Utils\WebServicesUpb;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;
use Session;

class RevisarController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verificar()
    {

        $sedes = Sedes::all();

        $key = Input::post('t_documento');
        $docentesall = Formulario::all();
        $usuarioesta = User::where('t_documento', '=', $key)->first();
        $usuariohoy = "";
        $nombrecompleto = "";
        $idusuario = "";
        $viculoconu = "";
        //$usuarioesta=null;

        $errorenform = "";
        
        $contestohoy = "NO";
        $puedeingresar = "SI";
        $idsigaa="NO";

        $fechahoy = date('Y-m-d 00:00:00');
        //dd($fechahoy);

        if (!is_null($usuarioesta)) {
            $nombrecompleto = $usuarioesta->t_nombres . " " . $usuarioesta->t_apellidos;
            $viculoconu = $usuarioesta->vinculou->t_vinculo;            
            $idsigaa=$usuarioesta->t_sigaa;
            $idusuario = $usuarioesta->n_idusuario;
            $formhoy = Formulario::where([
                ['n_idusuario', '=', $idusuario],
                ['created_at', '>', $fechahoy],
                ['t_activo', '=', "SI"],
            ])->first();
            if (!is_null($formhoy)) {
                $contestohoy = "SI";
            }
            if ($contestohoy == "SI") {
                $hoyformulario = $formhoy->n_idformulario;
                return redirect()->route('formulario.show', ['id' => $hoyformulario])->with('status', 'Resultado Previamente Guardado');
            } else {
                Session::put('idUsuario', $idusuario);
                if ($idsigaa=="SI"){
                  return redirect()->route('loginupb')->with('status', 'Debe hacer login de usuario para llenar el formulario');
                }
                else{
                  return redirect()->route('formulario.create');
                }
            }            //dd($usuarioesta);
        } else {
            $usuarioBanner=BannerServices::getUsuarioBannerNroDocumento($key);            
            if($usuarioBanner!=null){                
                $data=WebServicesUpb::isExisteLdap($usuarioBanner->id);
                if($data->CN==$usuarioBanner->id){
                    if($data->lastlogon<>0){
                        return redirect()->route('loginupb')->withErrors(array('usuario' =>'Ud. es Usuario UPB, Por favor autentíquese' ));
                    }
                }            
            }else{
                 $usuarioBanner=BannerServices::getUsuarioBanner($key);
                 if($usuarioBanner!=null){
                    $data=WebServicesUpb::isExisteLdap($usuarioBanner->id);
                    if($data->CN==$usuarioBanner->id){
                        if($data->lastlogon<>0){
                            return redirect()->route('loginupb')->withErrors(array('usuario' =>'Ud. es Usuario UPB, Por favor autentíquese' ));
                        }
                    }
                 }                 
            }
            $errorenform = "Usuario No Existe";
        }
        //var_dump($docentesall);
        return view('revisar.verificar', [
            'nombrecompleto' => $nombrecompleto,
            'idusuario' => $idusuario,
            'docentesall' => $docentesall,
            'errorenform' => $errorenform,
            'contestohoy' => $contestohoy,
            'viculoconu' => $viculoconu,
            'usuarioesta' => $usuarioesta,
            'sedes' => $sedes,
            't_documento' => $key,
        ])->with('status', 'El Docente Nuevo fue creado con éxito');
    }
}
