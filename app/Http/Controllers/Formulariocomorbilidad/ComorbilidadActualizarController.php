<?php

namespace App\Http\Controllers\Formulariocomorbilidad;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\FormularioComorbilidad;
use Session;
use DB;
use DataTables;
use Auth;
use Log;
use Exception;

class ComorbilidadActualizarController extends Controller
{
    public function index()
    {
        $objetos=['prueba'=>null];                 
        return view('formulariocomorbilidad.actualizarcomorbilidad',$objetos);
        
    }


    public function consultar()
    {
        if(request('parametro')==null){ return Datatables::of(array())->make(true);}

        $sql="SELECT fc.N_IDFORMULARIO_COMORBILIDAD id        ,fC.N_IDUSUARIO id_usuario        ,u.T_NOMBRES || ' ' ||u.T_APELLIDOS nombre
                ,u.T_DOCUMENTO documento,u.T_IDSIGAA pidm        ,decode(u.T_SIGAA,'SI','UPB','EXTERNO') tipo        ,fc.T_CONSENTIMIENTO consentimiento 
                ,TO_CHAR(fc.CREATED_AT,'DD/MM/YYYY') fecha 
                ,DECODE(fc.N_SEMAFORO,1,'VERDE',2,'AMARILLO','ROJO') SEMAFORO
                ,fc.N_SEMAFORO n_semaforo
                FROM formulario_comorbilidad fc INNER JOIN users u ON (fc.N_IDUSUARIO= u.N_IDUSUARIO)
                WHERE fc.T_ACTIVO='SI' 
                /*    AND fc.T_CONSENTIMIENTO=SI AND fc.N_SEMAFORO > 1*/
                AND (u.T_IDSIGAA= ? OR u.T_DOCUMENTO= ? ) ";
        
        $query = DB::select($sql,[request('parametro'),request('parametro')]);
        return Datatables::of($query)
                ->addColumn('accion', function ($registro) {
                        if($registro->consentimiento!='NO' && $registro->n_semaforo > 1 ){
                            return '<button type="button" class="btn btn-warning btn-actualizar"
                                    data-id="'.$registro->id.'"  data-nombre="'.$registro->nombre.'" data-fecha="'.$registro->fecha.'"
                                    data-documento="'.$registro->documento.'" data-pidm="'.$registro->pidm.'" >
                                    <span class="fas fa-minus-circle" alt="Actualizar"></span></button>';
                        }else{
                            return ' ';
                        }
           })->rawColumns(['accion'])->setRowId('id')->make(true);

    }

    public function envioActualizar()
    {
        $response=array();
        if(request('id_formulario')==null){ return response()->json(array('status' => '0','msg' =>'No se puede Actualizar El Acta')); }
        $formulario=FormularioComorbilidad::find(request('id_formulario'));
        $formulario->n_idactualiza=Auth::id();
        $formulario->n_semaforo=1;
        try {
            DB::beginTransaction();            
            $formulario->saveOrFail();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            $response = array('status' => '0','msg' =>'***ERROR GRAVE AL GUARDAR**** Contacte Con el Administrador del sistema');
            return response()->json($response);
       }
       $response = array('status' => '1','msg' =>'Se Actualizo semaforo VERDE en la encuesta de Estado de Salud');
       return response()->json($response);
    }


    public function consultarEncuestaDiaria()
    {
        if(request('parametro')==null){ return Datatables::of(array())->make(true);}
        $fechahoy = date('d/m/Y');
        $sql = "SELECT f.N_IDFORMULARIO id ,f.N_IDUSUARIO id_usuario,u.T_NOMBRES || ' ' ||u.T_APELLIDOS nombre
                ,u.T_DOCUMENTO documento,u.T_IDSIGAA pidm,decode(u.T_SIGAA,'SI','UPB','EXTERNO') tipo ,f.T_CONSENTIMIENTO consentimiento 
                ,TO_CHAR(f.CREATED_AT,'DD/MM/YYYY') fecha 
                ,DECODE(f.N_SEMAFORO,1,'VERDE',2,'AMARILLO','ROJO') SEMAFORO
                ,f.N_SEMAFORO n_semaforo 
                from formulario f  INNER JOIN users u ON (f.N_IDUSUARIO= u.N_IDUSUARIO)
                WHERE f.T_ACTIVO='SI'                 
                and trunc(f.created_at) = to_date(?,'dd/mm/yyyy')                 
                AND (u.T_IDSIGAA= ? OR u.T_DOCUMENTO= ? ) ";

        $query = DB::select($sql,[$fechahoy,request('parametro'),request('parametro')]);
        return Datatables::of($query)->setRowId('id')->make(true);

    }

    


}
