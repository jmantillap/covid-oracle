<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Validator;
use App\Services\UsuarioServices;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class PerfilController extends Controller
{
    public function __construct()  {
        $this->middleware('auth');
    }
  
    public function showPerfil()  {
        return view('administrador.perfil');
    }
  
    public function envioGuardarPerfil()  {
      $this->validate(request(),[
          't_login'=> 'required|string',
          'actual_password'=>'required|string'
      ]);
      $credentials = [
          't_login' => request('t_login'),
          'password' => request('actual_password'),
      ];
      if (Auth::attempt($credentials) ){
          $validator = Validator::make(request()->all(), [
              'password' => 'required|string|min:6|confirmed',
          ]);
          if ($validator->fails()){              
              return back()->withErrors($validator->messages())->withInput(request(['actual_password']));
          }else{
              $servicioUsuario= new UsuarioServices();
              $servicioUsuario->actualizarPassword(Auth::id(), bcrypt(request('password')));
              Session::flash('flash', 'La contraseña se actualizo satisfactoriamente');
              return back();
          }
       }
       return back()->withErrors(['actual_password'=>'Contraseña no valida'])->withInput(request(['actual_password']));
    }
}
