<?php

namespace App\Http\Controllers\Ciudad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Entidades\Ciudad;
use Auth;
use Session;
use Validator;
use DB;
use Log;
use Exception;
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06-10
 */
class CiudadController extends Controller
{
    private $administrador;
    
    
    public function __construct(){
        $this->middleware('auth');    
        $this->ciudad= new Ciudad();        
    }
    public function cargarListas()
    {
        
    }

    public function index(){
        if(Auth::id()!=1){
            redirect()->route('home');
        }
        if(Session::has('idCiudadModificar')){
            $this->ciudad=Ciudad::find(Session::get('idCiudadModificar'));            
        }else{
            $this->ciudad=new Ciudad();
            $this->ciudad->b_habilitado =1;
        }
        return $this->mostrarView();        
    }

    private function mostrarView($messages='')
    {
        $this->cargarListas();
        $objetos=['ciudad'=>$this->ciudad];         
        if($messages==''){
            return view('ciudad.ciudad',$objetos);
        }else{
            return view('ciudad.ciudad',$objetos)->withErrors($messages);
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
            $this->ciudad->saveOrFail();            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);            
            return $this->mostrarView(array('message' => '*** ERROR GRAVE AL GUARDAR **** Contacte Con el Administrador del sistema'));
        }
        Session::put('idCiudadModificar',$this->ciudad->n_id);
        $accion='Registro';
        if(request('n_id')!=null ){
             $accion='Actualizo';
        }
        Session::flash('flash', 'La Ciudad se '.$accion.' satisfactoriamente  Id:'.$this->ciudad->n_id );        
        //Session::flash('flash', 'El Administrador se guardo satisfactoriamente');        
        return redirect()->route('ciudad.mostrar'); 

    }

    private function validarCampos(){
        $rules = [];
        if(Session::has('idCiudadModificar') && request('n_id')!=null ){
            //Actualizar           
                $rules =['t_nombre' => 'required|string|max:100',
                         't_nombre' => Rule::unique('ciudades')->ignore($this->ciudad->n_id, 'n_id'),                    
                        ];
        }else{
            //nuevo
                $rules =['t_nombre' => 'required|string|max:100|unique:ciudades',];
        }
        $validator = Validator::make(request()->all(),$rules,$this->mensajesPersonalizados());
        return $validator;
    }

    private function cargarRequest(){
        if(Session::has('idCiudadModificar') && request('n_id')!=null ){
            $this->ciudad=Ciudad::find(Session::get('idCiudadModificar'))->fill(request()->all());            
        }else{
            $this->ciudad= new Ciudad(request()->all());            
        }
        $this->ciudad->b_habilitado=request('b_habilitado')!=null ? '1' : '0';        
        //dd($this->administrador);
    }
    private function mensajesPersonalizados()
    {
        return $custom=['t_nombre.required'=>'El Nombre requerido',                                                
                        't_nombre.unique' => 'El Nombre ya existe',                        
                        ];
    }

}
