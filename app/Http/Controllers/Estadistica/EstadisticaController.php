<?php

namespace App\Http\Controllers\Estadistica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConsultaFormularioExport;
use Validator;
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class EstadisticaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');            
    }

    public function index(){   
        $objetos=['lista'=>null];         
        return view('estadistica.estadistica',$objetos);
    }

    public function getDatosGraficaFiebreAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){
            $fecha_desde=request('fecha_desde');
        }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){
            $fecha_hasta=request('fecha_hasta');
        }
        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_presentadofiebre='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_presentadofiebre='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI'
            AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_presentadofiebre ";


        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no
              FROM (".$sqlInterno.") t
              GROUP BY t.ciudad ";
        
        //dd($sql);        
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);
        //return  json_encode($query);
        return response()->json($query);
    }

    public function getDatosGraficaSecrecionAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_secresioncongestionnasal='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_secresioncongestionnasal='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD'))  ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_secresioncongestionnasal ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaViajeAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_realizoviaje='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_realizoviaje='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_realizoviaje ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaGargantaAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_dolorgarganta='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_dolorgarganta='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_dolorgarganta ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaMalestarAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_malestargeneral='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_malestargeneral='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_malestargeneral ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaRepirarAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_dificultadrespirar='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_dificultadrespirar='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_dificultadrespirar ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaTosAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_tosseca='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_tosseca='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_tosseca ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaContactoAjax()
    {
        if(request('fecha_desde')==null || request('fecha_hasta')==null ){    return response()->json(array()); } 

        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, NVL(SUM(CASE WHEN f.t_contactopersonasinfectadas='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,NVL(SUM(CASE WHEN f.t_contactopersonasinfectadas='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
            AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sqlInterno.=" AND s.n_idciudad=".$idCiudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_contactopersonasinfectadas ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function generarExcelFormularios()
    {
        $validator = Validator::make(request()->all(), [
            'fecha_desde' => 'required|date','fecha_hasta' => 'required|date',
        ]);
        if ($validator->fails()){
            $messages = $validator->messages();
            return view('estadistica.estadistica',['null'=>null,])->withErrors($messages);
        }
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta');}    

        $sql="SELECT f.n_idformulario,trunc(f.created_at) fecha  ,u.t_nombres ,u.t_apellidos,v.t_vinculo vinculo,c.t_nombre ciudad,s.t_sede,f.t_consentimiento
        ,f.t_irahoy ,f.t_sitios,f.t_actividades,f.t_presentadofiebre,f.t_diasfiebre ,f.t_dolorgarganta
        ,f.t_malestargeneral,f.t_secresioncongestionnasal,f.t_dificultadrespirar,f.t_tosseca,f.t_contactopersonasinfectadas
        ,f.d_ultimocontacto,f.t_realizoviaje,f.d_ultimoviaje,f.created_at,f.updated_at
        from formulario f inner join users u on (f.n_idusuario=u.n_idusuario) INNER JOIN sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
        left join vinculou v on (v.n_idvinculou=u.n_idvinculou)
        where f.t_activo='SI'  AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
        AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD'))";
        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sql.=" AND s.n_idciudad=".$idCiudad; 
        }
        $registros = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);
        //dd($registros);
        return Excel::download(new ConsultaFormularioExport($registros), 'CONSULTAS_FORMULARIOS.xlsx');
    }

}
