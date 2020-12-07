<?php
 
namespace App\Http\Controllers\Loginupb;
use App\User;
use App\Entidades\Formulario;
use App\Entidades\Sedes;
use App\Entidades\Ciudad;
use Validator;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Session;
//Importanto las validaciones
use App\Http\Requests\SaveFormularioRequest;
use DB;
use Auth;
use Log;
use Exception;
use App\Services\FormularioServices;


class FormularioupbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      
       if(!Session::has('idUsuario') ||  !Session::has('userUPB') ){
            return route()->redirec('home');
       } 
       $key = Session::get('idUsuario');
       $usuarioesta=User::where('t_documento','=',$key)->first();
       //var_dump($key);
      return view('formularioupb.index', 
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
      
      return view('formularioupb.inactivar', 
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
    public function listarSedesAjax($request)
    {   
        $sql = "SELECT n_idsede, t_sede
        FROM(SELECT DISTINCT n_idsede, t_sede,n_idciudad FROM upb_covid.sedes WHERE t_sede ='TRABAJO EN CASA' UNION SELECT n_idsede, t_sede,n_idciudad FROM(SELECT n_idsede, t_sede,n_idciudad FROM sedes WHERE t_sede != 'TRABAJO EN CASA' ORDER BY t_sede))
        WHERE n_idciudad = :n_idciudad";
       /* $sql = "SELECT n_idsede, t_sede FROM sedes 
                 WHERE n_idciudad = :n_idciudad
              ORDER BY t_sede";*/

        $sedes = DB::select($sql, ['n_idciudad' => request('n_idciudad')]);

        return response()->json($sedes);
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Session::has('userUPB') || !Session::has('idUsuario') ){            
            return redirect()->route("home");   
        } 
        $key = Session::get('idUsuario');
        $usuarioesta=User::where('n_idusuario','=',$key)->first();
	    $fechahoy = date('d/m/Y');
        $sql = "select * from formulario where n_idusuario = :n_idusuario and trunc(created_at) = to_date(:created_at,'dd/mm/yyyy') and t_activo ='SI'";
        $formhoy = collect(DB::select($sql, ['n_idusuario'=>$key,'created_at'=>$fechahoy]))->first();
        if($formhoy!=null){                
             return redirect()->route('formularioupb.show2', ['id' => $formhoy->n_idformulario])->with('status', 'Resultado Previamente Guardado');
        }               
        $viculoconu=$usuarioesta->vinculou->t_vinculo;
        $ciudades = Ciudad::where('b_habilitado', '=', '1')->orderBY('t_nombre')->get();        
        return view('formularioupb.create',['formulario' => new Formulario,'n_idusuario'=>$key,'usuarioesta'=>$usuarioesta,'ciudades' => $ciudades,
            'viculoconu'=>$viculoconu
          ]);
    }

    public function store(SaveFormularioRequest $request)
    {
        $semaforonegacion="NO";
        $semafororojo="NO";
        $semaforo=1;        
        $campos= ($request->validated());        
        $miscampos=array($campos);                
	    $fechahoy = date('d/m/Y');
        $sql = "SELECT * from formulario WHERE n_idusuario = :n_idusuario and trunc(created_at) = to_date(:created_at,'dd/mm/yyyy') and t_activo ='SI'";
        $formhoy = collect(DB::select($sql, ['n_idusuario'=>$request->n_idusuario,'created_at'=>$fechahoy]))->first();
        if($formhoy!=null){
              return redirect()->route('formularioupb.show2', ['id' => $formhoy->n_idformulario])->with('status', 'Resultado Previamente Guardado');
        }
        if(!Session::has('idUsuario') || Session::get('idUsuario')!=$request->n_idusuario ){
            Session::forget('idUsuario');
            Session::forget('userUPB');
            return redirect()->route('home')->with('error', 'No se guardo el formulario Vuelva a Autenticarse..');
        }
        if  ($miscampos[0]['t_consentimiento']=="NO")$semaforonegacion="SI"; 
        if  ($miscampos[0]['t_presentadofiebre']=="SI")$semaforonegacion="SI"; 
        if  ($miscampos[0]['t_dolorgarganta']=="SI")$semaforonegacion="SI"; 
        if  ($miscampos[0]['t_malestargeneral']=="SI")$semaforonegacion="SI"; 
        if  ($miscampos[0]['t_secresioncongestionnasal']=="SI")$semaforonegacion="SI"; 
        //if  ($miscampos[0]['t_realizoviaje']=="SI")$semaforonegacion="SI";  //Se realiza cambio segun correo de badder. 23 sep 2020
        if  ($miscampos[0]['t_dificultadrespirar']=="SI"){
                $semaforonegacion="SI";
                $semafororojo="SI"; 
        }
        if  ($miscampos[0]['t_tosseca']=="SI")$semaforonegacion="SI"; 
        
        if ($miscampos[0]['t_perdolfa'] == "SI") $semafororojo = "SI";
        if ($miscampos[0]['t_molestia_diges'] == "SI") $semaforonegacion = "SI";        
        if ($miscampos[0]['t_sigue_aislado'] == "SI") $semafororojo = "SI";

        if  ($miscampos[0]['t_personalsalud']=="NO" && $miscampos[0]['t_contactopersonasinfectadas']=="SI" )$semaforonegacion="SI"; 
        if ($semafororojo=="SI"){
            $semaforo="3";
        }else{
            if ($semaforonegacion=="SI"){
                $semaforo="2";
            }else{
                $semaforo="1";    
            }
        }
        if($miscampos[0]['t_personalsalud']=="SI" && request('t_contactopersonasinfectadas')==null ){
            $campos['t_contactopersonasinfectadas']="SI";    
        }        
        $campos['n_semaforo']=$semaforo;        
        $campos['t_realizoviaje']='NO'; /* Se realiza cambio en vista para que no muestre la pregunta de viaje segun reunion 07/12/2020 */
        $resultado=Formulario::create($campos)->n_idformulario; //solo envia los que esten validados por CreateProjectRequest
        
        return redirect()->route('formularioupb.show2',[$resultado])->with('status','El formulario se guardó con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formulario $formulario)
    {      
      dd($formulario->n_idformulario);
      $acta=FormularioServices::getActaCovidUsuario($formulario->n_idusuario); 
      return view('formularioupb.show', ['formulario' => $formulario,'acta' => $acta ]);
    }

    public function show2($id)
    {
        $formulario=Formulario::find($id);
        $acta=FormularioServices::getActaCovidUsuario($formulario->n_idusuario); 
        return view('formularioupb.show', ['formulario' => $formulario,'acta' => $acta]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

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
            't_personalsalud' => 'required',  
            't_contactopersonasinfectadas' => 'sometimes',            
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
            't_personalsalud.required' => "No has Respondido acerca de la cercanía con personas infectadas",
            't_contactopersonasinfectadas.sometimes' => "No has Respondido acerca de la cercanía con personas infectadas",
            't_realizoviaje.required' => "No has Respondido acerca de su ultimo viaje"
         ];
    }
    
}
