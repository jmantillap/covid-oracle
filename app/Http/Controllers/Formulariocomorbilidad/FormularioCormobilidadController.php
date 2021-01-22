<?php

namespace App\Http\Controllers\Formulariocomorbilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FormularioServices;
use App\User;
use App\Entidades\FormularioComorbilidad;
use DB;
use Log;
use Exception;
use Session;
use Validator;


class FormularioCormobilidadController extends Controller
{
    private $formulario;

    public function index()
    {      
        
       if(!Session::has('userUPB') || !Session::has('idUsuario') ){
            return redirect()->route('home');
       }elseif(FormularioServices::getEncuestaComorbilidad()!=null){
            Session::flash('flash', 'Ya diligencio La encuesta de comorbilidad.' );
            return redirect()->route('home');
       }
       $this->formulario=new FormularioComorbilidad();               
       return $this->mostrarView();  
    }
    private function mostrarView($messages='')
    {
        $user=User::find(Session::get('idUsuario'));
        if($user->n_idvinculou==1){
           $vinculo="ESTUDIANTES"; 
           $modalidad="estudio";
        }elseif ($user->n_idvinculou==2 || $user->n_idvinculou==3 || $user->n_idvinculou==4){
           $vinculo="PROFESORES Y PERSONAL ADMINISTRATIVO"; 
           $modalidad="trabajo";
        }elseif($user->n_idvinculou==5){
            $vinculo="PROVEEDORES";
            $modalidad="trabajo";
        }else{
            $vinculo=strtoupper($user->vinculou->t_vinculo).'S';
            $modalidad="trabajo";
        }
        $objetos=['usuario'=>$user,'formulario'=>$this->formulario,'vinculo'=>$vinculo,'modalidad'=>$modalidad]; 
        if($messages==''){
            return view('formulariocomorbilidad.encuestacomorbilidad',$objetos);
        }else{
            return view('formulariocomorbilidad.encuestacomorbilidad',$objetos)->withErrors($messages);
        }
    }

    public function envioGuardar()
    {
        $this->cargarRequest();
        $validator = Validator::make(request()->all(),['t_consentimiento' => 'required|string|min:2|max:2'],['t_consentimiento.required'=>'Debe Aceptar o no El consentimiento']);        
        if ($validator->fails()) { return redirect('encuesta/comorbilidad')->withErrors($validator)->withInput(); }
        $validator=$this->validarCampos();
        //dd(request()->all());
        if ($validator->fails()) { return redirect('encuesta/comorbilidad')->withErrors($validator)->withInput(); }
        if(request('t_consentimiento')=='NO'){
            $this->formulario= new FormularioComorbilidad(["t_consentimiento" => "NO"]);            
            $this->formulario->n_semaforo='3';
        }else{            
            $this->formulario->t_convive_mayor=request('t_convive_mayor')!=null ? request('t_convive_mayor') : 'NO';
            $this->formulario->t_convive_bajas_defensas=request('t_convive_bajas_defensas')!=null ? request('t_convive_bajas_defensas') : 'NO';
            $this->formulario->t_convive_pulmonar=request('t_convive_pulmonar')!=null ? request('t_convive_pulmonar') : 'NO';
            $this->formulario->t_convive_cancer=request('t_convive_cancer')!=null ? request('t_convive_cancer') : 'NO';
            $this->formulario->t_convive_otras=request('t_convive_otras')!=null ? request('t_convive_otras') : 'NO';
            $this->formulario->n_semaforo='1';
        }
        $this->formulario->n_idusuario=Session::get('idUsuario');
        $this->formulario->t_activo='SI';
        try {
            DB::beginTransaction();           
            $this->formulario->saveOrFail();            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);            
            return $this->mostrarView(array('message' => '*** ERROR GRAVE AL GUARDAR **** Contacte Con el Administrador del sistema'));
        }
        Session::flash('flash', 'ESTADO DE SALUD PARA PREVENCIÓN DE COVID-19 se almacenó correctamente.' );                
        return redirect()->route('home'); 
    }

    private function cargarRequest()
    {
        $this->formulario = new FormularioComorbilidad(request()->all());
        if(request('t_convive_otras')==null){
            $this->formulario->t_convive_cual=null;
        }
        $this->formulario->n_idusuario=Session::get('idUsuario');
    }

    private function validarCampos(){
        $reglas=array();        
        if(request('t_consentimiento')=='NO'){
            $validator = Validator::make(request()->all(),$reglas,array());
        }elseif(request('t_consentimiento')=='SI'){
            $reglas=['n_peso' => 'required|integer|min:30|max:150',
                    'n_talla' => 'required|integer|min:50|max:230',
                    't_fuma' => 'required|string|in:SI,NO',
                    't_hipertension' => 'required|string|in:SI,NO',
                    't_diabetes' => 'required|string|in:SI,NO',
                    't_corazon' => 'required|string|in:SI,NO',
                    't_pulmonar' => 'required|string|in:SI,NO',
                    't_medicamento_defensas_bajas' => 'required|string|in:SI,NO',
                    't_inmunodeficiencia' => 'required|string|in:SI,NO',
                    't_cancer' => 'required|string|in:SI,NO',
                    'n_cigarrillos_dia' => 'nullable|required_if:t_fuma,==,SI|integer|min:1|max:30|',
                    't_medicamento_hipertension' => 'required_if:t_hipertension,==,SI',
                    't_medicamento_diabetes' => 'required_if:t_diabetes,==,SI',
                    't_enfermedad_corazon' => 'required_if:t_corazon,==,SI',
                    't_enfermedad_pulmonar' => 'required_if:t_pulmonar,==,SI',
                    't_cuales_med_defensas_bajas' => 'required_if:t_medicamento_defensas_bajas,==,SI',
                    't_quimioterapia_cancer' => 'required_if:t_cancer,==,SI',                    
                    't_convive_cual' => 'required_if:t_convive_otras,==,SI',];
            $validator = Validator::make(request()->all(),$reglas,$this->mensajesPersonalizados());
        }        
        return $validator;
    }


    private function mensajesPersonalizados()
    {
        return $custom=['n_peso.required'=>'El Peso en Kilogramos es requerido',
                        'n_peso.min'=>'El Peso en Kilogramos minimo es 30 kg',
                        'n_peso.max'=>'El Peso en Kilogramos máximo es 150 kg',                        
                        'n_talla.required' => 'la talla en centímetros es requerida',
                        'n_talla.min' => 'la talla minima es de 50 cm',
                        'n_talla.max' => 'la talla máxima es de 230 cm',
                        't_fuma.required' => 'Debe seleccionar si fuma o no',
                        't_hipertension.required' => 'Debe seleccionar hipertensión',
                        't_diabetes.required' => 'Debe seleccionar Diabetes',
                        't_corazon.required' => 'Debe seleccionar enfermedad de Corazón',
                        't_pulmonar.required' => 'Debe seleccionar enfermedad Pulmonar',
                        't_medicamento_defensas_bajas.required' => 'Defensas bajas es requerido',
                        't_inmunodeficiencia.required' => 'Inmunodeficiencia Adquirida es requerida',
                        't_cancer.required' => 'Cancer es requerido',
                        'n_cigarrillos_dia.required_if' => 'Cuantos cigarrillos al Día',
                        'n_cigarrillos_dia.min' => 'Los Cigarrillos deben ser mayor a 0',                        
                        't_medicamento_hipertension.required_if' => 'Que medicamentos',
                        't_medicamento_diabetes.required_if' => 'Que medicamentos',
                        't_enfermedad_corazon.required_if' => 'Que Enfermedades',
                        't_enfermedad_pulmonar.required_if' => 'Que Enfermedades',
                        't_cuales_med_defensas_bajas.required_if' => 'Que medicamentos',
                        't_quimioterapia_cancer.required_if' => 'Quimioterapia',
                        't_convive_cual.required_if' => '¿Convive Otra? ¿Cuál?',
                        ];
                    
    }
}
