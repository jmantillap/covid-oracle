<?php

namespace App\Http\Controllers\Loginupb;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Entidades\AuditoriaIngreso;
use App\Entidades\Administrador;
use App\Utils\WebServicesUpb;
use Auth;
use Config;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Log;
use Exception;
use DB;
use Session;

use App\Entidades\Formulario;
use App\Services\BannerServices;
use App\Entidades\Sedes;
use App\User;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class LoginupbController extends Controller
{
   
    public function __construct()
    {
        date_default_timezone_set('America/Bogota');
        $this->middleware('guest',['only'=>'showLoginForm']); 
    }

    public function showLoginForm()
    {
            return view('loginupb.login');
    }

    public function irLogin()
    {
        return redirect()->route('login');
    }

    public function validarLogin()    {

        $this->validate(request(),['usuario' => 'required|string','password'=>'required|string']);

       
            $data=WebServicesUpb::getAutenticacion(request('usuario'),request('password'));
            if($data->ESTADO=="AUTORIZADO"){
                return $this->validarUsuario(); 
            }else{
                return back()->withErrors(array('usuario' =>$data->ESTADO ))->withInput(request(['usuario']));    
            }            
       
    }

    public function validarUsuario()
    {
       $idbanner=request('usuario');

       $contestohoy="NO";

        
       
       //$usuario_sel = collect(DB::select($elquery ,['idBanner' => $idbanner]))->first();

       $usuario_sel=BannerServices::getUsuarioBanner($idbanner);

       //dd($usuario_sel);

       //dd(array($usuario_sel,$idbanner));
       
       if($usuario_sel!=null){
            Session::put('vs_ussel',$usuario_sel);
            $documentous=$usuario_sel->documento;
            ///$documentous='687686824682364287';

            $docentesall= Formulario::all();
            $usuarioesta=User::where('t_documento','=',$documentous)->first();

            //dd($usuarioesta);

            if ($usuarioesta!=null)
                {
                    $fechahoy= date('Y-m-d 00:00:00');
                    
                    $formhoy=Formulario::where([
                        ['n_idusuario', '=', $usuarioesta->n_idusuario],
                        ['created_at', '>', $fechahoy],
                        ['t_activo', '=', "SI"],
                    ])->first();

                    if (!is_null($formhoy)) $contestohoy="SI";

                    if ($contestohoy=="SI"){
                        $hoyformulario=$formhoy->n_idformulario;
                        return redirect()->route('formularioupb.show2', ['id' => $hoyformulario])->with('status','Resultado Previamente Guardado');
          
                    }
                    else
                    {
                      Session::put('idUsuario',$usuarioesta->n_idusuario);
          
                    return redirect()->route('formularioupb.create');
          
                    }
          


                }
            else
                {
                    return redirect()->route('usersupb.create')->with('status','Debe Registrar los datos faltantes');;
                } 


            
            Session::forget('vs_ussel');
            
       } 
      
       
        return "Hola mundo";
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

