<?php

namespace App\Http\Controllers\Ciudad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Ciudad;
use Auth;
use Session;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06-10
 */
class ListarCiudadController extends Controller
{
    /**
    * Constructor.
    */
    public function __construct(){
        $this->middleware('auth');        
    }

    public function index(){
        if(Auth::id()!=1){
            redirect()->route('/');
        }
        Session::forget('idCiudadModificar');
        $ciudades=Ciudad::all();        
        return view('ciudad.listarciudad',['ciudades'=>$ciudades]);
    }

     public function seleccionar(){
        if(request('idCiudadSeleccionada')!=null){
            Session::put('idCiudadModificar',request('idCiudadSeleccionada'));            
        }else{
            Session::forget('idCiudadModificar');            
        }
        return redirect()->route('ciudad.mostrar');
    }

    public function envioNuevo()    {
        
        Session::forget('idCiudadModificar');
        return redirect()->route('ciudad.mostrar');
    }
}
