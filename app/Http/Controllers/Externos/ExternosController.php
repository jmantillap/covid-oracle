<?php

namespace App\Http\Controllers\Externos;

use App\Entidades\Formulario;
use App\Entidades\Sedes;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;
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

        $fechahoy = date('Y-m-d 00:00:00');
        //dd($fechahoy);

        if (!is_null($usuarioesta)) {
            $nombrecompleto = $usuarioesta->t_nombres . " " . $usuarioesta->t_apellidos;
            $viculoconu = $usuarioesta->vinculou->t_vinculo;

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

                return redirect()->route('formulario.create');

            }

            //dd($usuarioesta);
        } else {
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

    public function homeext()
    {        
        return view('externos.homeext');
    }
}
