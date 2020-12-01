<?php

namespace App\Http\Controllers\Consulta;

use App\Entidades\Formulario;
use App\Entidades\Sedes;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;
use Session;

class ConsultaController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultar()
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
                $errorenform =  "NO HA CONTESTADO EL FORMULARIO";
            }            
        } else {
            $errorenform = "Documento de Usuario No Registrado";
        }
        return view('consulta.consultar', ['nombrecompleto' => $nombrecompleto,'idusuario' => $idusuario,'errorenform' => $errorenform,
            'contestohoy' => $contestohoy,'viculoconu' => $viculoconu,'usuarioesta' => $usuarioesta,'t_documento' => $key,
            'fechahoy'=>$fechahoy])->with('status', 'El Docente Nuevo fue creado con éxito');
    }

    public function homeconsulta()
    {
        return view('consulta.homeconsulta');
    }
}
