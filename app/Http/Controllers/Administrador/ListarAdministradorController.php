<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Administrador;
use Auth;
use Session;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class ListarAdministradorController extends Controller
{
    /**
    * Constructor.
    */
    public function __construct(){
        $this->middleware('auth');        
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        if(Auth::id()!=1 || Auth::id()!=101){
            redirect()->route('home');
        }
        Session::forget('idAdministradorModificar');
        $administradores=Administrador::all();
        //se pas el usuario.
        return view('administrador.listaradministrador',['administradores'=>$administradores]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function seleccionar(){
        if(request('idAdministradorSeleccionado')!=null){
            Session::put('idAdministradorModificar',request('idAdministradorSeleccionado'));            
        }else{
            Session::forget('idAdministradorModificar');            
        }
        return redirect()->route('administrador.mostrar');
    }

    public function envioNuevo()
    {
        //dd("Entro");
        Session::forget('idAdministradorModificar');
        return redirect()->route('administrador.mostrar');
    }
}
