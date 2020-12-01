<?php

namespace App\Http\Controllers\Externos;

use App\Entidades\Formulario;
use App\Entidades\Sedes;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Services\FormularioServices;
use Session;

class ExternosController extends Controller
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
        $usuariohoy = "";
        $nombrecompleto = "";
        $idusuario = "";
        $viculoconu = "";       

        $errorenform = "";

        $contestohoy = "NO";
        $puedeingresar = "SI";

        $fechahoy = date('Y-m-d 00:00:00');
                
        if (!is_null($usuarioesta)) {
            $nombrecompleto = $usuarioesta->t_nombres . " " . $usuarioesta->t_apellidos;
            $viculoconu = $usuarioesta->vinculou->t_vinculo;
            $idusuario = $usuarioesta->n_idusuario;
            $formhoy = Formulario::where([['n_idusuario', '=', $idusuario],['created_at', '>', $fechahoy],['t_activo', '=', "SI"],])->first();
            if (!is_null($formhoy)) {
                $contestohoy = "SI";
            }
            if ($contestohoy == "SI") {
                $hoyformulario = $formhoy->n_idformulario;
                unset($formhoy);
                return redirect()->route('formulario.show', ['id' => $hoyformulario])->with('status', 'Resultado Previamente Guardado');
            } else {
                Session::put('idUsuario', $idusuario);
                return redirect()->route('formulario.create');
            }
        } else {
            $errorenform = "Usuario No Existe";
        }

        return view('revisar.verificar', [
            'nombrecompleto' => $nombrecompleto,
            'idusuario' => $idusuario,            
            'errorenform' => $errorenform,
            'contestohoy' => $contestohoy,
            'viculoconu' => $viculoconu,
            'usuarioesta' => $usuarioesta,            
            't_documento' => $key,
        ])->with('status', 'El Docente Nuevo fue creado con éxito');
    }

    public function homeext()
    {        
        if(Session::has('userUPB') && Session::get('userUPB')->n_idusuario!=null ){
            $formularioHoy=FormularioServices::formularioHoy();
            if($formularioHoy!=null){
                return redirect()->route('formularioupb.show2', ['id' => $formularioHoy->n_idformulario])->with('status','Resultado Previamente Guardado');
            }else{
                Session::put('idUsuario',Session::get('userUPB')->n_idusuario);
                return redirect()->route('formularioupb.create');
            }
        }
        return view('externos.homeext');
    }

    // public function formularioHoy()
    // {
    //     $fechahoy= date('Y-m-d 00:00:00');                    
    //     $formhoy=Formulario::where([['n_idusuario', '=', Session::get('userUPB')->n_idusuario],['created_at', '>', $fechahoy],['t_activo', '=', "SI"],])->first();
    //     return $formhoy;
    // }
}
