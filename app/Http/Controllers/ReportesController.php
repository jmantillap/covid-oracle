<?php

namespace App\Http\Controllers;
use App\User;
use App\Entidades\Formulario;
use App\Entidades\Sedes;
use Validator;

use Illuminate\Http\Request;

//Importanto las validaciones
use App\Http\Requests\SaveFormularioRequest;
use DB;
use Auth;
use DataTables;

class ReportesController extends Controller
{
    public function index(){
        return view('reportes.index', 
        [
            
        ]);  
    }

    public function getReporte1Formularios()
    {
      $id_ciudad=auth()->user()->n_idciudad;
      $todas=auth()->user()->b_todas;
      $fechahoy=date('Y-m-d 00:00:00');

      $fecha_desde='1900-12-31';
      
      if(request('fecha_desde')!=null){
          $fecha_desde=request('fecha_desde');
      }
      $fecha_hasta='1900-12-31';
      if(request('fecha_hasta')!=null){
          $fecha_hasta=request('fecha_hasta');
      }
      $fecha_desde=$fecha_desde;
      $fecha_hasta=$fecha_hasta.' 23:59:59';

      //dd($fecha_hasta);
        //$elselect= "SELECT * ";
        $elselect="select fo.*,se.*,us.* ";
        //$elselect .= " ,CONCAT('(',us.c_codtipo,' ',us.t_documento,') ',us.t_nombres,' ',us.t_apellidos) as nombrec, fo.t_activo as activo";        
        $elselect .= " ,'(' ||us.c_codtipo|| ' ' || us.t_documento ||')' || us.t_nombres || ' ' ||us.t_apellidos as nombrec , fo.t_activo as activo ";        
        $elselect .= " ,fo.created_at as fechacreated, fo.updated_at as fechaupdate";
        $elselect .= " FROM formulario fo, users us, sedes se";
        //$elselect .= " where fo.created_at >=:fecha_desde";
        $elselect .= " where fo.created_at >= trunc(to_date(:fecha_desde, 'YY/MM/DD')) ";          
        //$elselect .= " and fo.created_at <= :fecha_hasta";
        $elselect .= " and fo.created_at <= (to_date(:fecha_hasta, 'YY/MM/DD HH24:MI:SS')) ";
        $elselect .= " and fo.n_semaforo>1";
        $elselect .= " and us.n_idusuario=fo.n_idusuario";
        $elselect .= " and se.n_idsede= fo.n_idsede"; 
        if ($todas=="1")$elselect .= " and se.n_idciudad>0";
        else $elselect .= " and se.n_idciudad=".$id_ciudad;

        $elselect .= " order by fo.created_at";

        //dd($elselect);

        $query = DB::select($elselect,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        

        //dd($elselect);
      
        //return datatables()->of($query)
        return Datatables::of($query)
        /*
        ->addColumn('action', function ($registro) {
            if ($registro->activo=="SI")return '<a href="'.route('formulario.updateinac', $registro->n_idformulario).'"> Inactivar</a>';
            if ($registro->activo=="NO")return 'DESACTIVADO';

        
    })
    */
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

/*-------------------------------------
----- Funciones del Reporte 2 ---------
-------------------------------------*/

public function reporte2(){
    return view('reportes.reporte2', 
    [
        
    ]);  
}

public function getReporte2Formularios()
{
  $id_ciudad=auth()->user()->n_idciudad;
  $todas=auth()->user()->b_todas;
  $fechahoy=date('Y-m-d 00:00:00');

  $fecha_desde='1900-12-31';
  
  if(request('fecha_desde')!=null){
      $fecha_desde=request('fecha_desde');
  }
  $fecha_hasta='1900-12-31';
  if(request('fecha_hasta')!=null){
      $fecha_hasta=request('fecha_hasta');
  }
  $fecha_desde=$fecha_desde;
  $fecha_hasta=$fecha_hasta.' 23:59:59';

  //dd($fecha_hasta);
    //$elselect= "SELECT * ";
    $elselect="select fo.*,se.*,us.* ";
    //$elselect .= " ,CONCAT('(',us.c_codtipo,' ',us.t_documento,') ',us.t_nombres,' ',us.t_apellidos) as nombrec, fo.t_activo as activo";
    $elselect .= " ,'(' ||us.c_codtipo|| ' ' || us.t_documento ||')' || us.t_nombres || ' ' ||us.t_apellidos as nombrec , fo.t_activo as activo ";        
    $elselect .= " ,fo.created_at as fechacreated, fo.updated_at as fechaupdate";
    $elselect .= " FROM formulario fo, users us, sedes se";
    //$elselect .= " where fo.created_at >=:fecha_desde";
    $elselect .= " where fo.created_at >= trunc(to_date(:fecha_desde, 'YY/MM/DD')) ";          
    //$elselect .= " and fo.created_at <= :fecha_hasta";
    $elselect .= " and fo.created_at <= (to_date(:fecha_hasta, 'YY/MM/DD HH24:MI:SS')) ";
    //$elselect .= " and fo.n_semaforo>1";
    $elselect .= " and us.n_idusuario=fo.n_idusuario";
    $elselect .= " and se.n_idsede= fo.n_idsede"; 
    if ($todas=="1")$elselect .= " and se.n_idciudad>0";
    else $elselect .= " and se.n_idciudad=".$id_ciudad;

    $elselect .= " order by fo.created_at";

    //dd($elselect);

    $query = DB::select($elselect,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);

    //dd($elselect);
  
    //return datatables()->of($query)
    return Datatables::of($query)
    /*
    ->addColumn('action', function ($registro) {
        if ($registro->activo=="SI")return '<a href="'.route('formulario.updateinac', $registro->n_idformulario).'"> Inactivar</a>';
        if ($registro->activo=="NO")return 'DESACTIVADO';

    
})
*/
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

/*-------------------------------------
----- Funciones del Reporte 3 ---------
-------------------------------------*/

public function reporte3(){
    return view('reportes.reporte3', 
    [
        
    ]);  
}

public function getReporte3Formularios()
{
  $id_ciudad=auth()->user()->n_idciudad;
  $todas=auth()->user()->b_todas;
  $fechahoy=date('Y-m-d 00:00:00');

  $fecha_desde='1900-12-31';
  
  if(request('fecha_desde')!=null){
      $fecha_desde=request('fecha_desde');
  }
  $fecha_hasta='1900-12-31';
  if(request('fecha_hasta')!=null){
      $fecha_hasta=request('fecha_hasta');
  }
  $fecha_desde=$fecha_desde.' 00:00:00';
  $fecha_hasta=$fecha_hasta.' 23:59:59';

  //dd(request('documento'));

  $documento='000000000';
  if(request('documento')!=null){
      $documento=request('documento');
  }

  //dd($fecha_hasta);
    //$elselect= "SELECT * ";
    $elselect="select fo.*,se.*,us.* ";
    //$elselect .= " ,CONCAT('(',us.c_codtipo,' ',us.t_documento,') ',us.t_nombres,' ',us.t_apellidos) as nombrec, fo.t_activo as activo";
    $elselect .= " ,'(' ||us.c_codtipo|| ' ' || us.t_documento ||')' || us.t_nombres || ' ' ||us.t_apellidos as nombrec , fo.t_activo as activo ";        
    $elselect .= " ,fo.created_at as fechacreated, fo.updated_at as fechaupdate";
    $elselect .= " FROM formulario fo, users us, sedes se";
    //$elselect .= " where fo.created_at >=:fecha_desde";
    $elselect .= " where fo.created_at >= trunc(to_date(:fecha_desde, 'YY/MM/DD HH24:MI:SS')) ";          
    //$elselect .= " and fo.created_at <= :fecha_hasta";
    $elselect .= " and fo.created_at <= (to_date(:fecha_hasta, 'YY/MM/DD HH24:MI:SS')) ";
    $elselect .= " and us.t_documento= :documento";
    $elselect .= " and us.n_idusuario=fo.n_idusuario";
    $elselect .= " and se.n_idsede= fo.n_idsede"; 
    if ($todas=="1"){
        $elselect .= " and se.n_idciudad>0";
    }else { 
        $elselect .= " and se.n_idciudad=".$id_ciudad;
    }

    $elselect .= " order by fo.created_at";

    //dd($elselect);

    $query = DB::select($elselect,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta , 'documento'=>$documento]);

    //dd($elselect);
  
    //return datatables()->of($query)
    return Datatables::of($query)
    /*
    ->addColumn('action', function ($registro) {
        if ($registro->activo=="SI")return '<a href="'.route('formulario.updateinac', $registro->n_idformulario).'"> Inactivar</a>';
        if ($registro->activo=="NO")return 'DESACTIVADO';

    
})
*/
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

/*-------------------------------------
----- Funciones del Reporte 4 ---------
-------------------------------------*/

public function reporte4(){
    return view('reportes.reporte4', 
    [
        
    ]);  
}

public function getReporte4Formularios()
{
  $id_ciudad=auth()->user()->n_idciudad;
  $todas=auth()->user()->b_todas;
  $fechahoy=date('Y-m-d');

  $fecha_desde='1900-12-31';

 
  
  if(request('fecha_desde')!=null){
      $fecha_desde=request('fecha_desde');
      
  }
  else
  {
    return Datatables::of(array())->make(true);
  }
  $fecha_hasta=$fecha_desde.' 23:59:59';
  $fecha_desde=$fecha_desde.' 00:00:00';
  

  

  //dd($fecha_desde);


 //$elselect= "SELECT *";
 $elselect= "SELECT us.*,se.*,vi.*,ci.*";
$elselect .= " FROM users us, sedes se, vinculou vi, ciudades ci";
//$elselect .= " WHERE us.n_idusuario NOT IN (SELECT fo.n_idusuario FROM formulario fo where fo.created_at>=:fecha_desde and fo.created_at<=:fecha_hasta and fo.t_activo='SI')";
$elselect .= " WHERE us.n_idusuario NOT IN (SELECT fo.n_idusuario FROM formulario fo where fo.created_at>=to_date(:fecha_desde, 'YY/MM/DD HH24:MI:SS') and fo.created_at<=to_date(:fecha_hasta, 'YY/MM/DD HH24:MI:SS') and fo.t_activo='SI')";
$elselect .= " AND us.n_idsede=se.n_idsede";
$elselect .= " AND us.n_idvinculou=vi.n_idvinculou";
$elselect .= " AND se.n_idciudad=ci.n_id";

//dd($elselect);
   
    if ($todas=="1"){
        $elselect .= " and se.n_idciudad>0";
    }else { 
        $elselect .= " and se.n_idciudad=".$id_ciudad;
    }

    $elselect .= " order by us.t_apellidos, us.t_nombres";

    //dd($elselect);

    $query = DB::select($elselect,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta ]);

   
  
    //return datatables()->of($query)
    return Datatables::of($query)
    /*
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
*/
->toJson();
}



}
