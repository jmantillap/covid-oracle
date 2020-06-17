<?php

namespace App\Http\Controllers;
use App\User;
use App\Entidades\Formulario;
use App\Entidades\Sedes;
use Validator;
use Illuminate\Http\Request;
use Session;
//Importanto las validaciones
use App\Http\Requests\SaveFormularioRequest;
use DB;
use Auth;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      
       if(!Session::has('idUsuario')){

         return route()->redirec('home');

       } 
       $key = Session::get('idUsuario');
       $usuarioesta=User::where('t_documento','=',$key)->first();
       //var_dump($key);
      return view('formulario.index', 
        [
            'formulario'=> Formulario::orderBy('n_idusuario','ASC')->paginate(10)
        ]);  
    }


    public function inactivar()
    {
      /*
      var_dump(auth()->user()->n_idciudad);
      var_dump(auth()->user()->ciudad->t_nombre);
      var_dump(auth()->user()->n_id);
      var_dump(Auth::id());
*/ 
      
      return view('formulario.inactivar', 
        [
            'sedes'=> Sedes::orderBy('t_sede','ASC')->paginate(10)
        ]);  
    }

    public function getListaFormularios()
    {
      $id_ciudad=auth()->user()->n_idciudad;
      $fechahoy=date('Y-m-d 00:00:00');

      //$elselect= "select *,CONCAT('(',us.c_codtipo,' ',us.t_documento,') ',us.t_nombres,' ',us.t_apellidos) as nombrec, fo.t_activo as activo from formulario fo,sedes se, users us where se.n_idsede=fo.n_idsede and se.n_idciudad=".$id_ciudad;

      $elselect="select fo.*,se.*,us.*
      ,'(' ||us.c_codtipo|| ' ' || us.t_documento ||')' || us.t_nombres || ' ' ||us.t_apellidos as nombrec      
      , fo.t_activo as activo 
      from formulario fo,sedes se, users us where se.n_idsede=fo.n_idsede and se.n_idciudad= ".$id_ciudad  ;
      //$elselect .= " and fo.updated_at>='".$fechahoy."'";
      $elselect .= " and fo.updated_at>= trunc(to_date('".$fechahoy."','YY/MM/DD HH24:MI:SS')) ";
      
      $elselect .= " and us.n_idusuario=fo.n_idusuario";
      
        $query = DB::select($elselect);

        //dd($query);
      
        return datatables()->of($query)
        ->addColumn('action', function ($registro) {
            if ($registro->activo=="SI")return '<a href="'.route('formulario.updateinac', $registro->n_idformulario).'"> Inactivar</a>';
            if ($registro->activo=="NO")return 'DESACTIVADO';

        
    })
    ->addColumn('semaforo', function ($registro) {
        if ($registro->n_semaforo=="1")return '<strong class="text-success">Verde</strong>';
        if ($registro->n_semaforo=="2")return '<strong class="text-warning">Amarillo</strong>';
        if ($registro->n_semaforo=="3")return '<strong class="text-danger">Rojo</strong>';
    })
    ->addColumn('ingreso', function ($registro) {
    if ($registro->n_semaforo=="1")return '<strong class="text-success">SI</strong>';
    if ($registro->n_semaforo=="2")return '<strong class="text-danger">NO</strong>';
    if ($registro->n_semaforo=="3")return '<strong class="text-danger">NO</strong>';
    })
    ->rawColumns(['action','semaforo','ingreso'])
    ->toJson();
    }

    public function updateinac($request)
    {
       
        //return $request;
        
        $affected = DB::table('formulario')
              ->where('n_idformulario', $request)
              ->update(['t_activo' => "NO", 'n_iddesactiva' => Auth::id(),'updated_at'=>date('Y-m-d H:i:s')]);
        return redirect()->route('formulario.inactivar')->with('status','El formulario fue actualizado con éxito');


    }
   

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Session::has('idUsuario')){

            return route()->redirec('home');
   
          } 
          $key = Session::get('idUsuario');

          $usuarioesta=User::where('n_idusuario','=',$key)->first();

          
          $viculoconu=$usuarioesta->vinculou->t_vinculo;
          $sedes= Sedes::all();
        //$project = Project::findOrFail($id);
         return view('formulario.create',[
            'formulario' => new Formulario,
            'n_idusuario'=>$key,
            'usuarioesta'=>$usuarioesta,
        'sedes'=>$sedes,
        'viculoconu'=>$viculoconu

          ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2()
    {
       
       //dd(request()->all());
        $validator=Validator::make(request()->all(),$this->rules(),$this->messages());

       
     
        if($validator->fails()){
          //dd("Fallo"); 
           return   redirect()->back()->withErrors( $validator->errors());
        }

        $formulario= new Formulario(request()->all());        
        $formulario->t_texto=request('t_texto');
        $formulario->id_usuario=Session::get('idUsiario');
        dd(formulario);
        $formularo->save();

        Session::forget('idUsuario');
        Session::put('id_formulario',$formulario->n_idformulario);
        //Formulario::create($validator); //solo envia los que esten validados por CreateProjectRequest
        return redirect()->route('home')->with('status','La sede fue creado con éxito');
    }



    


    public function store(SaveFormularioRequest $request)
    {
        $semaforonegacion="NO";
        $semafororojo="NO";
        $semaforo=1;
        //dd($request->validated());
        $campos= ($request->validated());
        $miscampos=array($campos);
        
         if  ($miscampos[0]['t_consentimiento']=="NO")$semaforonegacion="SI"; 
         if  ($miscampos[0]['t_presentadofiebre']=="SI")$semaforonegacion="SI"; 
         if  ($miscampos[0]['t_dolorgarganta']=="SI")$semaforonegacion="SI"; 
         if  ($miscampos[0]['t_malestargeneral']=="SI")$semaforonegacion="SI"; 
         if  ($miscampos[0]['t_secresioncongestionnasal']=="SI")$semaforonegacion="SI"; 
         if  ($miscampos[0]['t_dificultadrespirar']=="SI"){
                $semaforonegacion="SI";
                $semafororojo="SI"; 
            }
         if  ($miscampos[0]['t_tosseca']=="SI")$semaforonegacion="SI"; 
         if  ($miscampos[0]['t_contactopersonasinfectadas']=="SI")$semaforonegacion="SI"; 

            if ($semafororojo=="SI"){
                $semaforo="3";
            }
            else    
            {
                if ($semaforonegacion=="SI"){
                    $semaforo="2";
                }
                else
                {
                    $semaforo="1";    
                }
            }
     


        $campos['n_semaforo']=$semaforo;
        //dd($campos);
        
        $resultado=Formulario::create($campos)->n_idformulario; //solo envia los que esten validados por CreateProjectRequest

      //return redirect()->route('home')->with('status','La sede fue creado con éxito');

      return redirect()->route('formulario.show', ['id' => $resultado])->with('status','El formulario se guardó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formulario $formulario)
    {
      
      return view('formulario.show', [
            'formulario' => $formulario
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function rules()
    {
        return [
            'n_idusuario' => 'required',
            'n_idsede' => 'required',
            't_consentimiento' => 'required',
            't_irahoy' => 'required',
            't_sitios' => 'sometimes',
            't_actividades' => 'sometimes',
            't_presentadofiebre' => 'required',
            't_diasfiebre' => 'sometimes|integer|min:0|max:200',
            't_dolorgarganta' => 'required',
            't_malestargeneral' => 'required',
            't_secresioncongestionnasal' => 'required',
            't_dificultadrespirar' => 'required',
            't_tosseca' => 'required',
            't_contactopersonasinfectadas' => 'required',            
            'd_ultimocontacto' => 'sometimes',
            't_realizoviaje' => 'required', 
            'd_ultimoviaje' => 'sometimes'


           

        ];
    }



    private function messages(){

        return [
            'n_idusuario.required' => "No ha selecionado la persona",
            //'t_nombres.min' => "El Nombre del Docente debe tener el menos 3 caracteres",
            //'t_nombres.max' => "El Nombre del  Docente debe tener máximo 100 caracteres",
            't_consentimiento.required' => "No has dado el consentimiento",
            'n_idsede.required' => "No has seleccionado la sede",
            't_irahoy.required' => "Debe responder si ira hoy a la Universidad",
            't_presentadofiebre.required' => "No has respondido si presento fiebre",
            't_dolorgarganta.required' => "No respondió a la pregunta sobre el dolor de garganta",
            't_malestargeneral.required' => "No has respondido sobre el malestar general",
            't_secresioncongestionnasal.required' => "No has respondido acerca de la Cosgentión Nasal",
            't_dificultadrespirar.required' => "No has Respondido acerca de la dificultad al respirar",
            't_tosseca.required' => "No has Respondido acerca de la tos seca",
            't_contactopersonasinfectadas.required' => "No has Respondido acerca de la cercanía con personas infectadas",
            't_realizoviaje.required' => "No has Respondido acerca de su ultimo viaje"
         ];
    }
    
}
