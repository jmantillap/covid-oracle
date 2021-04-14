<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Vinculou;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormularioDiarioEmpleadoExport;
use DB;
use Validator;
use Config;

class ReporteEncuestaEmpleadoController extends Controller
{
    private $listaVinculo;
    
    public function index(){        
        $this->llenarLista();
        $objetos=['listaVinculo'=>$this->listaVinculo];
        return view('reportes.encuestadiariaempleados',$objetos);  
    }
    private function llenarLista()
    {
        $this->listaVinculo=Vinculou::orderBy('t_vinculo','asc')->get();
        if(auth()->user()->b_estudiantes==1){
            $this->listaVinculo=Vinculou::where('n_idvinculou','=',Config::get('pregunta.n_idestudiante'))->orderBy('t_vinculo','asc')->get();            
        }
    }

    public function generarExcelDiariaEmpleado()
    {
        $validator = Validator::make(request()->all(), ['fecha_desde' => 'required|date','fecha_hasta' => 'required|date',]);
        if ($validator->fails()){
            $this->llenarLista();            
            $objetos=['listaVinculo'=>$this->listaVinculo];
            return view('reportes.encuestadiariaempleados',$objetos)->withErrors($validator->messages());
        }        
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta');}

        $sql="SELECT f.n_idformulario id_formulario,trunc(f.created_at) fecha,u.t_idsigaa,u.t_documento  ,u.t_nombres ,u.t_apellidos,v.t_vinculo vinculo,c.t_nombre ciudad,s.t_sede,f.t_consentimiento
        ,f.t_irahoy ,f.t_sitios,f.t_actividades,f.t_presentadofiebre,f.t_diasfiebre ,f.t_dolorgarganta
        ,f.t_malestargeneral,f.t_secresioncongestionnasal,f.t_dificultadrespirar,f.t_tosseca,f.t_personalsalud,f.t_contactopersonasinfectadas
        ,f.d_ultimocontacto,f.t_realizoviaje,f.d_ultimoviaje,f.created_at,f.updated_at
        ,f.t_perdolfa,f.t_molestia_diges,f.t_sigue_aislado
        ,E.CENTRO_COSTO,E.NOMBRE_CENTRO_COSTO,E.SECCIONAL,E.TIPO_EMPLEADO,E.CARGO
        ,DECODE(F.N_SEMAFORO,1,'VERDE',2,'AMARILLO','ROJO') SEMAFORO
        from  formulario f inner join users u on (f.n_idusuario=u.n_idusuario ) INNER JOIN sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
        left join vinculou v on (v.n_idvinculou=u.n_idvinculou)
        INNER join SPRIDEN ON (SPRIDEN_PIDM = U.T_IDSIGAA AND SPRIDEN_CHANGE_IND IS NULL AND U.T_SIGAA = 'SI')
        inner join (SELECT A.ID_BANNER ID         
                   ,DECODE(SUBSTR(B.EMPRESA,2,1),'M','Medellín','B','Bucaramanga','T','Montería','P','Palmira','C','Clínica','D','Bogotá') SECCIONAL
                   ,B.CENTRO_COSTO
                   ,(SELECT CC.NOMBRE_CENTRO_COSTO FROM CENTRO_COSTO@ICEBANDBL CC WHERE CC.CENTRO_COSTO = B.CENTRO_COSTO) NOMBRE_CENTRO_COSTO
                   ,(SELECT D.NOMBRE_DEPENDENCIA FROM DEPENDENCIA@ICEBANDBL D WHERE D.DEPENDENCIA= B.DEPENDENCIA) DEPENDENCIA
                   ,B.TIPO_CONTRATO
                   ,(SELECT UPPER(DESCRIPCION) FROM TIPO_EMPLEADO WHERE TIPO_EMPLEADO=B.TIPO_EMPLEADO) TIPO_EMPLEADO
                   ,(SELECT UPPER(CA.NOMBRE_CARGO) FROM CARGO CA WHERE CA.CARGO=B.CARGO AND CA.GRADO=B.GRADO AND CA.NIVEL=B.NIVEL) CARGO
                   ,SUBSTR(B.EMPRESA,2,1) EMPRESA
                FROM EMPLEADO@ICEBANDBL B,RELACION_BANNER_ICEBERG@ICEBANDBL A
                WHERE B.SECUENCIA_PERSONA = A.SECUENCIA_PERSONA
                AND B.EMPLEADO = ((SELECT MAX(B3.EMPLEADO)
                                  FROM EMPLEADO@ICEBANDBL B3
                                  WHERE B3.FECHA_INGRESO = NVL((SELECT MAX(B2.FECHA_INGRESO) FROM EMPLEADO@ICEBANDBL B2 WHERE B2.NIT=B3.NIT AND B2.ESTADO = 'A')
                                                              ,(SELECT MAX(B2.FECHA_INGRESO) FROM EMPLEADO@ICEBANDBL B2 WHERE B2.NIT=B3.NIT)) AND B3.NIT = B.NIT))
                ) E
                ON ( SPRIDEN_PIDM = E.ID )                                                        
        WHERE f.t_activo='SI'  AND TRUNC(f.created_at)>= trunc(to_date(:fecha_desde, 'YY/MM/DD'))  
        AND TRUNC(f.created_at)<=trunc(to_date(:fecha_hasta, 'YY/MM/DD')) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sql.=" AND s.n_idciudad=".$idCiudad; 
        }
        if(request('n_idvinculou')!=null){ $sql.=" AND u.n_idvinculou=".request('n_idvinculou');  }        
        if(auth()->user()->b_estudiantes==1){ $sql.=" AND u.n_idvinculou=".Config::get('pregunta.n_idestudiante'); }    
        $registros = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        

        return Excel::download(new FormularioDiarioEmpleadoExport($registros), 'FORMULARIO_DIARIO_EMPLEADO_UPB.xlsx');
    }
}
