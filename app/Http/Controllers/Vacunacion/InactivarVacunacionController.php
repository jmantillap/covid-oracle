<?php

namespace App\Http\Controllers\Vacunacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Vacunacion;
use Session;
use DB;
use DataTables;
use Auth;
use Log;
use Exception;

class InactivarVacunacionController extends Controller
{
    
    public function index()
    {
        $objetos=['prueba'=>null];                 
        return view('vacunacion.inactivarvacunacion',$objetos);        
    }

    public function consultar()
    {
        if(request('parametro')==null){ return Datatables::of(array())->make(true);}

        $sql="SELECT fc.N_ID id ,fc.N_IDUSUARIO id_usuario,u.T_NOMBRES || ' ' ||u.T_APELLIDOS nombre
            ,u.T_DOCUMENTO documento,u.T_IDSIGAA pidm,decode(u.T_SIGAA,'SI','UPB','EXTERNO') tipo        
            ,fc.t_vacuna vacuna 
            ,TO_CHAR(fc.CREATED_AT,'DD/MM/YYYY') fecha 
            FROM vacunacion fc INNER JOIN users u ON (fc.N_IDUSUARIO= u.N_IDUSUARIO)
            WHERE fc.T_ACTIVO='SI' 
            AND (u.T_IDSIGAA= ? OR u.T_DOCUMENTO= ? ) ";
        
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
        if(request('id_formulario')==null){ return response()->json(array('status' => '0','msg' =>'No se puede Inactivar El Registro de Vacunación')); }
        $vacunacion=Vacunacion::find(request('id_formulario'));
        $vacunacion->n_iddesactiva=Auth::id();
        $vacunacion->t_activo='NO';
        try {
            DB::beginTransaction();            
            $vacunacion->saveOrFail();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack(); Log::error($e);//$response = array('status' => '0','msg' =>'***ERROR GRAVE AL GUARDAR**** Contacte Con el Administrador del sistema');
            return response()->json(array('status' => '0','msg' =>'***ERROR GRAVE AL GUARDAR**** Contacte Con el Administrador del sistema'));
       }
       $response = array('status' => '1','msg' =>'Se inactivo el registro de vacunación');
       return response()->json($response);
    }


}
