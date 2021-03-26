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
        $key = Input::post('t_documento');
        $usuarioesta = User::where('t_documento', '=', $key)->first();
        $usuariohoy = "";         $nombrecompleto = "";        $idusuario = "";        $viculoconu = "";        $errorenform = "";        
        $contestohoy = "NO";        $puedeingresar = "SI";        $idsigaa="NO";
        $fechahoy = date('Y-m-d 00:00:00');
        if (!is_null($usuarioesta)) {
            $nombrecompleto = $usuarioesta->t_nombres . " " . $usuarioesta->t_apellidos;
            $viculoconu = $usuarioesta->vinculou->t_vinculo;            
            $idsigaa=$usuarioesta->t_sigaa;
            $idusuario = $usuarioesta->n_idusuario;
            $formhoy = Formulario::where([['n_idusuario', '=', $idusuario],['created_at', '>', $fechahoy],['t_activo', '=', "SI"],])->first();
            if (!is_null($formhoy)) {
                $contestohoy = "SI";
            }
            Session::put('idUsuario', $idusuario);
            if ($contestohoy == "SI") {                
                $hoyformulario = $formhoy->n_idformulario;
                return redirect()->route('formulario.show', ['id' => $hoyformulario])->with('status', 'Resultado Previamente Guardado');
            } else {                
                Session::forget('userUPB');
                if ($idsigaa=="SI"){ 
                  Session::forget('idUsuario');                                         
                  return redirect()->route('loginupb')->with('status', 'Ud. es Usuario UPB, Por favor autentíquese');
                }else{
                  return redirect()->route('formulario.create');
                }
            }            
        } else {
            $usuarioBanner=BannerServices::getUsuarioBannerNroDocumento($key);           
            if($usuarioBanner!=null){                
                $data=WebServicesUpb::isExisteLdap($usuarioBanner->id);
                if($data->CN==$usuarioBanner->id){
                    if($data->lastlogon<>0){
                        Session::forget('userUPB');
                        Session::forget('idUsuario');
                        return redirect()->route('loginupb')->withErrors(array('usuario' =>'Ud. es Usuario UPB, Por favor autentíquese' ));
                    }
                }            
            }else{
                 $usuarioBanner=BannerServices::getUsuarioBanner($key);
                 if($usuarioBanner!=null){
                    $data=WebServicesUpb::isExisteLdap($usuarioBanner->id);
                    if($data->CN==$usuarioBanner->id){
                        if($data->lastlogon<>0){
                            Session::forget('userUPB');
                            Session::forget('idUsuario');
                            return redirect()->route('loginupb')->withErrors(array('usuario' =>'Ud. es Usuario UPB, Por favor autentíquese' ));
                        }
                    }
                 }
            }
            $errorenform = "Usuario No Existe";
        }        
        Session::put('documentoCreate', $key);
        return view('revisar.verificar', ['nombrecompleto' => $nombrecompleto,'idusuario' => $idusuario,            /*'docentesall' => $docentesall,*/
            'errorenform' => $errorenform,'contestohoy' => $contestohoy, 'viculoconu' => $viculoconu,
            'usuarioesta' => $usuarioesta,           
            't_documento' => $key,])->with('status', 'El Docente Nuevo fue creado con éxito');
    }

    public function getRevisar()
    {
        Session::forget('userUPB');
        Session::forget('idUsuario');
        return redirect()->route('home');
    }
}
