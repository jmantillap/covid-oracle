<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Entidades\AuditoriaIngreso;
use Auth;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class LoginController extends Controller
{
   
    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
        $this->middleware('guest',['only'=>'showLoginForm']); 
    }

    public function showLoginForm()
    {
            return view('auth.login');
    }

    public function irLogin()
    {
        return redirect()->route('login');
    }

    public function validarLogin()    {

        $this->validate(request(),['usuario' => 'required|string','password'=>'required|string']);

        $credentials = [$this->username() => request('usuario'),'password' => request('password'),];

        if (Auth::attempt($credentials)) {
           if(auth()->user()->b_habilitado=='1'){               
               $this->auditoriaIngreso(request());               
               return redirect()->route('estadistica');
           } else{
               $this->logout();
           }
       }
        return back()->withErrors(['usuario'=>trans('auth.failed')])->withInput(request(['usuario']));
    }

    public function auditoriaIngreso($request)
     {
        $auditoria=new AuditoriaIngreso();
        $auditoria->n_idadministrador=Auth::id();
        $auditoria->t_ip=$_SERVER['REMOTE_ADDR'];
        $auditoria->t_navegador=$_SERVER['HTTP_USER_AGENT'];         
        $auditoria->save();
     }

     public function username()
     {
         return 't_login';
     }

     public function logout()
     {
             Auth::logout();
             return redirect('/');
     }


}
