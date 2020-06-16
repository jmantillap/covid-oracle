<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Administrador;
use App\Entidades\Ciudad;
use Auth;
use Session;
use Validator;
use DB;
use Log;
use Exception;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class AdministradorController extends Controller
{
    private $administrador;
    private $listaCiudades;
    
    public function __construct(){
        $this->middleware('auth');    
        $this->administrador= new Administrador();        
    }
    public function cargarListas()
    {
        $this->listaCiudades=Ciudad::orderBy('t_nombre')->get();        
    }

    public function index(){
        if(Auth::id()!=1){
            redirect()->route('home');
        }
        if(Session::has('idAdministradorModificar')){
            $this->administrador=Administrador::find(Session::get('idAdministradorModificar'));            
        }else{
            $this->administrador=new Administrador();
            $this->administrador->b_habilitado =1;
        }
        return $this->mostrarView();        
    }

    private function mostrarView($messages='')
    {
        $this->cargarListas();
        $objetos=['listaCiudades'=>$this->listaCiudades,'administrador'=>$this->administrador];         
        if($messages==''){
            return view('administrador.administrador',$objetos);
        }else{
            return view('administrador.administrador',$objetos)->withErrors($messages);
        }
    }


    public function envioGuardar()
    {
        $this->cargarRequest();                
        $validator=$this->validarCampos();
        if ($validator->fails()){     
            //dd($validator->messages());       
            return $this->mostrarView($validator->messages());
        }
        try {
            DB::beginTransaction();           
            $this->administrador->saveOrFail();            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);            
            return $this->mostrarView(array('message' => '*** ERROR GRAVE AL GUARDAR **** Contacte Con el Administrador del sistema'));
        }
        Session::put('idAdministradorModificar',$this->administrador->n_id);
        $accion='Registro';
        if(request('n_id')!=null ){
             $accion='Actualizo';
        }
        Session::flash('flash', 'Administrador se '.$accion.' satisfactoriamente  Id:'.$this->administrador->n_id );        
        //Session::flash('flash', 'El Administrador se guardo satisfactoriamente');        
        return redirect()->route('administrador.mostrar'); 


    }

    private function validarCampos(){
        $rules = [];
        if(Session::has('idAdministradorModificar') && request('n_id')!=null ){
            //Actualizar
            if(request('password')==null){
                $rules = [
                    't_nombrecompleto' => 'required|string|max:100',
                    't_email' => 'required|string|email|max:100',
                    'n_idciudad' => 'required|numeric|min:0',
                    't_login' => 'required|string|max:30',];
            }else{
                $rules =[
                    't_nombrecompleto' => 'required|string|max:100',
                    't_email' => 'required|string|email|max:100',
                    'n_idciudad' => 'required|numeric|min:0',
                    't_login' => 'required|string|max:30',
                    'password' => 'required|string|min:6|confirmed',];
            }
        }else{
            //nuevo
            $rules = [
                't_nombrecompleto' => 'required|string|max:100',                
                't_email' => 'required|string|email|max:100|unique:administradores',
                'n_idciudad' => 'required|numeric|min:0',
                't_login' => 'required|string|max:30|unique:administradores',
                'password' => 'required|string|min:6|confirmed',
            ];
        }
        $validator = Validator::make(request()->all(),$rules,$this->mensajesPersonalizados());
        return $validator;
    }

    private function cargarRequest(){
        if(Session::has('idAdministradorModificar') && request('n_id')!=null ){
            $this->administrador=Administrador::find(Session::get('idAdministradorModificar'))->fill(request()->all());
            if(request('password')!=null){
                $this->administrador->t_password=bcrypt(request('password'));
            }
        }else{
            $this->administrador= new Administrador(request()->all());
            $this->administrador->t_password=bcrypt(request('password'));            
        }
        $this->administrador->b_habilitado=request('b_habilitado')!=null ? '1' : '0';
        $this->administrador->b_todas=request('b_todas')!=null ? '1' : '0';        
        //dd($this->administrador);
    }

    private function mensajesPersonalizados()
    {
        return $custom=['t_nombrecompleto.required'=>'El Nombre requerido',
                        'n_idciudad.required' => 'La Ciudad es requerida',
                        't_email.required' => 'El Email es requerido',
                        't_email.unique' => 'El email ya existe',                        
                        't_email.max' => 'El email debe ser de menor caracteres',
                        't_login.required' => 'El login es requerido',                        
                        't_login.unique' => 'El login id de banner ya existe',
                        ];
    }




}
