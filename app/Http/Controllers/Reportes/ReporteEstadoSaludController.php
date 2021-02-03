<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Vinculou;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteEstadoSaludExport;
use DB;
use Validator;
use Config;

class ReporteEstadoSaludController extends Controller
{
    private $listaVinculo;

    public function index(){        
        $this->llenarLista();
        $objetos=['listaVinculo'=>$this->listaVinculo];         
        return view('reportes.estadosalud',$objetos);  
    }

    private function llenarLista()
    {
        $this->listaVinculo=Vinculou::orderBy('t_vinculo','asc')->get();
        if(auth()->user()->b_estudiantes==1){
            $this->listaVinculo=Vinculou::where('n_idvinculou','=',Config::get('pregunta.n_idestudiante'))->orderBy('t_vinculo','asc')->get();            
        }
    }

    public function generarExcelEstadoSalud()
    {
        $validator = Validator::make(request()->all(), ['fecha_desde' => 'required|date','fecha_hasta' => 'required|date',]);
        if ($validator->fails()){ return redirect('estado/salud')->withErrors($validator)->withInput(); }

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta');}    
        
        $sql="SELECT N_IDFORMULARIO_COMORBILIDAD id ,trunc(f.created_at) fecha,u.T_IDSIGAA,u.T_DOCUMENTO
        ,u.t_nombres ,u.t_apellidos,v.t_vinculo vinculo,c.t_nombre ciudad/*,s.t_sede*/
        ,f.t_consentimiento,f.N_PESO,f.n_talla,f.t_fuma,f.n_cigarrillos_dia,f.T_HIPERTENSION,f.T_MEDICAMENTO_HIPERTENSION
        ,f.t_diabetes,f.t_medicamento_diabetes,f.t_corazon,f.T_ENFERMEDAD_CORAZON,f.t_pulmonar,f.T_ENFERMEDAD_PULMONAR
        ,f.T_MEDICAMENTO_DEFENSAS_BAJAS	,f.T_CUALES_MED_DEFENSAS_BAJAS	,f.T_INMUNODEFICIENCIA	
        ,f.T_CANCER	,f.T_QUIMIOTERAPIA_CANCER	,f.T_CONVIVE_MAYOR	,f.T_CONVIVE_BAJAS_DEFENSAS	,f.T_CONVIVE_PULMONAR	,f.T_CONVIVE_OTRAS	,f.T_CONVIVE_CUAL
        ,f.T_ACTIVO	,decode(f.N_SEMAFORO,1,'OK','REVISAR') SEMAFORO
        FROM upb_covid.formulario_comorbilidad f inner join 
            users u on (f.n_idusuario=u.n_idusuario) INNER JOIN 
            sedes s on (u.n_idsede=s.n_idsede) INNER JOIN 
            ciudades c on (s.n_idciudad=c.n_id) left join 
            vinculou v on (v.n_idvinculou=u.n_idvinculou)
        where f.t_activo='SI' 
        AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
        AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sql.=" AND s.n_idciudad=".$idCiudad; 
        }
        if(request('n_idvinculou')!=null){ $sql.=" AND u.n_idvinculou=".request('n_idvinculou');  }
        if(auth()->user()->b_estudiantes==1){ $sql.=" AND u.n_idvinculou=".Config::get('pregunta.n_idestudiante'); }        
        $registros = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);    

        return Excel::download(new ReporteEstadoSaludExport($registros), 'REPORTE_ESTADO_SALUD.xlsx');

    }
}
