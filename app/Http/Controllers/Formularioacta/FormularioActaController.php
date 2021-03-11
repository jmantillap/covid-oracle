<?php

namespace App\Http\Controllers\formularioacta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\FormularioActa;
use App\Services\FormularioServices;
use App\User;
use Session;
use Validator;
use DB;
use Log;
use Exception;

class FormularioActaController extends Controller
{
    private $formulario;

    public function index()
    {      
       if(!Session::has('idUsuario')){
            return redirect()->route('home');
       }elseif(FormularioServices::getActaCovid()!=null){
            Session::flash('flash', 'Ya diligencio el acta covid.' );
            return redirect()->route('home');
       }               
       return $this->mostrarView();  
    }

    public function envioGuardar()
    {
        //dd(request()->all());
        $this->cargarRequest();                
        $validator=$this->validarCampos();
        if ($validator->fails()){                 
            return $this->mostrarView($validator->messages());        
        }
        try {
            DB::beginTransaction();           
            $this->formulario->saveOrFail();            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);            
            return $this->mostrarView(array('message' => '*** ERROR GRAVE AL GUARDAR **** Contacte Con el Administrador del sistema'));
        }
        Session::flash('flash', 'El acta COVID-19 se almaceno correctamente.' );                
        return redirect()->route('home'); 

    }
    private function mostrarView($messages='')
    {
        $user=User::find(Session::get('idUsuario'));        
        $objetos=['user'=>$user];         
        if($messages==''){
            return view('formularioacta.actacovid',$objetos);
        }else{
            return view('formularioacta.actacovid',$objetos)->withErrors($messages);
        }
    }

    private function cargarRequest(){
        $atributos=['n_idusuario'=>Session::get('idUsuario')
                    ,'t_consentimiento'=>request('t_consentimiento')
                    ,'t_activo'=>'SI'
                    ,'n_semaforo'=>(request('t_consentimiento')=='SI' ? '1' : '3') ];

        $this->formulario=new FormularioActa($atributos);
        //dd($this->formulario);
        
    }
    private function validarCampos(){        
        
        $rules =[ 't_consentimiento' => 'required'];
        $mensajes=['t_consentimiento.required' => "No has dado el consentimiento",];
        $validator = Validator::make(request()->all(),$rules,$mensajes);
        return $validator;
    }
}
