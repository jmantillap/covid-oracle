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

        $elquery=" SELECT DISTINCT";
        $elquery .=" SPRIDEN_PIDM pidm,";
        $elquery .=" SPRIDEN_ID id,";
        $elquery .=" SZRIDEN_ADID_CODE tipo_documento,";
        $elquery .=" SZRIDEN_DOC_ID documento,";
        $elquery .=" SPRIDEN_FIRST_NAME primer_nombre,";
        $elquery .=" SPRIDEN_MI segundo_nombre,";
        $elquery .=" SPRIDEN_LAST_NAME apellidos,";
        $elquery .=" goremal_email_address  correo,";
        $elquery .=" sprtele_phone_area codigo_area,";
        $elquery .=" sprtele_phone_number telefono,";
        $elquery .=" sprtele_phone_Ext extension,";
        $elquery .=" '(' || sprtele_phone_area || ')' || ' ' || sprtele_phone_number || ' ' ||";
        $elquery .=" DECODE (sprtele_phone_ext, NULL, NULL, 'ext: ' || sprtele_phone_Ext) telefono_completo";
        $elquery .=" FROM SZRIDEN";
        $elquery .=" JOIN SPRIDEN ON SZRIDEN_PIDM = SPRIDEN_PIDM AND SZRIDEN_PRINCIPAL_IND = 'Y'";
        $elquery .=" JOIN GOREMAL on SZRIDEN_PIDM = goremal_PIDM";
        $elquery .=" JOIN SPRTELE on SZRIDEN_PIDM = sprtele_PIDM";
        $elquery .=" AND SZRIDEN_PRINCIPAL_IND = 'Y'";
        $elquery .=" WHERE SPRIDEN_CHANGE_IND IS NULL";
        $elquery .=" AND spriden_entity_ind = 'P'";
        $elquery .=" AND ((SPRIDEN_ID) = NVL(:idBanner,'-9999') )";
        $elquery .=" AND goremal_preferred_ind='Y'";
        $elquery .=" and goremal_status_ind = 'A'";
        $elquery .=" and sprtele_tele_code='MA'";
        $elquery .=" and sprtele_status_ind is null";
       // $elquery .=" rownum= 1";
        $elquery .=" ORDER BY 1 ASC";

       
       $usuario_sel = collect(DB::select($elquery ,['idBanner' => $idbanner]))->first();
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


            dd($usuarioesta);
            
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






/* public function validarLogin()    {

    $this->validate(request(),['usuario' => 'required|string','password'=>'required|string']);

    $ws=true;
    if (!$ws){
        $credentials = [$this->username() => request('usuario'),'password' => request('password'),];
        if (Auth::attempt($credentials)) {
            if(auth()->user()->b_habilitado=='1'){               
                $this->auditoriaIngreso(request());               
                return redirect()->route('estadistica');
            } else{
                $this->logout();
            }
        }
    }else{
        
        $this->autenticarWsUtilitario();            

        
    }        
    return back()->withErrors(['usuario'=>trans('auth.failed')])->withInput(request(['usuario']));
} */



//$this->wsParamFuncionaExplicado();            
            //$this->wsInvocacion();   
            //$this->wsParamFunciona();



//$client = new Client();
            //$response = $client->request('GET', $baseUrl."/General/Autenticacion/?id=000253912&password=Pruebas2019",$headers);

//$headers=[  'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',]];
//$response = $client->request('GET', "/General/Autenticacion/?",['query' => ['id' => request('usuario'),'password' => request('password')]]);
//dd($response->getStatusCode());
//dd($response->getStatusCode());


/* private function wsInvocacion()
{
    $baseUrl = Config::get('ws.endpoint');            
    $headers=[ 'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',]];
    $client = new Client(['base_uri' => $baseUrl]);
    try {
        $response = $client->request('GET', "/General/Autenticacion/?id=000253912&password=Pruebas2019",$headers);            
        $data = json_decode($response->getBody());            
        dd($response->getHeaderLine('content-type'));
        dd($response);
        dd($data);           
    } catch (Exception $e) {
        Log::error($e);                            
        return back()->withErrors(array('usuario' => '*** ERROR GRAVE AL AUTENTICAR **** Contacte Con el Administrador del sistema'))->withInput(request(['usuario']));            
    }
}

private function wsParamFunciona()
{
    $baseUrl = Config::get('ws.endpoint');
    $headers=[  'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',]];
    $client = new Client(['base_uri' => $baseUrl]);
    $credentials ="id=".request('usuario')."&password=".request('password');        
    $request = new Request('GET', '/General/Autenticacion/?'.$credentials);        
    $response=$client->send($request,$headers);
    $data = json_decode($response->getBody());
     //dd($data);  
}

private function wsParamFuncionaExplicado()
{
    $baseUrl = Config::get('ws.endpoint');        
    $client = new Client(['base_uri' => $baseUrl]);
    $parametros=[
        'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',],
        'query' => ['id' => request('usuario'),'password' => request('password')],
    ];        
    $response = $client->request('GET', "/General/Autenticacion/?",$parametros);        
    $data = json_decode($response->getBody());
    dd($data);  
}

private function autenticarWsUtilitario()
{
    $data=WebServicesUpb::getAutenticacion(request('usuario'),request('password'));
    dd($data);
}
 */


/* $parametros=[ 'headers' => ['Username' => Config::get('ws.username'),'Password' => Config::get('ws.password'), 'Accept'     => 'application/json',]];            
$baseUrl="https://servibiblioteca.bucaramanga.upb.edu.co";
$client = new Client(['base_uri' => $baseUrl]);
try {                
    $response = $client->request('GET', "/rest/info.php?uid=java",$parametros);
    $data = json_decode($response->getBody());                
    //dd($response->getHeaderLine('content-type'));
    //dd($response);
    dd($data);           
} catch (Exception $e) {
    Log::error($e);                            
    return back()->withErrors(array('usuario' => '*** ERROR GRAVE AL AUTENTICAR **** Contacte Con el Administrador del sistema'))->withInput(request(['usuario']));                
} */

/* private function autenticarWsUtilitario()
    {
        $data=WebServicesUpb::getAutenticacion(request('usuario'),request('password'));
        dd($data);
    } */