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

class ComorbilidadInactivarController extends Controller
{
    public function index()
    {
        $objetos=['prueba'=>null];                 
        return view('formulariocomorbilidad.inactivarcomorbilidad',$objetos);
        
    }

    public function consultar()
    {
        if(request('parametro')==null){ return Datatables::of(array())->make(true);}

        $sql="SELECT fc.N_IDFORMULARIO_COMORBILIDAD id        ,fC.N_IDUSUARIO id_usuario        ,u.T_NOMBRES || ' ' ||u.T_APELLIDOS nombre
                ,u.T_DOCUMENTO documento,u.T_IDSIGAA pidm        ,decode(u.T_SIGAA,'SI','UPB','EXTERNO') tipo        ,fc.T_CONSENTIMIENTO consentimiento 
                ,TO_CHAR(fc.CREATED_AT,'DD/MM/YYYY') fecha 
                FROM formulario_comorbilidad fc INNER JOIN users u ON (fc.N_IDUSUARIO= u.N_IDUSUARIO)
                WHERE fc.T_ACTIVO='SI' 
                AND (u.T_IDSIGAA= ? OR u.T_DOCUMENTO= ?) ";
        
        $query = DB::select($sql,[request('parametro'),request('parametro')]);
        return Datatables::of($query)
                ->addColumn('accion', function ($registro) {
                return '<button type="button" class="btn btn-danger btn-inactivar"
                            data-id="'.$registro->id.'"              
                            data-nombre="'.$registro->nombre.'"
                            data-fecha="'.$registro->fecha.'"
                            data-documento="'.$registro->documento.'" >
                            <span class="fas fa-minus-circle" alt="Inactivar"></span>
                        </button>';
           })->rawColumns(['accion'])->setRowId('id')->make(true);

    }

    public function envioInactivar()
    {
        $response=array();
        if(request('id_formulario')==null){ return response()->json(array('status' => '0','msg' =>'No se puede Inactivar El Acta')); }
        $formulario=FormularioComorbilidad::find(request('id_formulario'));
        $formulario->n_iddesactiva=Auth::id();
        $formulario->t_activo='NO';
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
       $response = array('status' => '1','msg' =>'Se inactivo la encuesta de Comorbildidad');
       return response()->json($response);
    }
}
