<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Vinculou;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteVacunacionExport;
use DB;
use Validator;
use Config;

class ReporteVacunacionController extends Controller
{
    private $listaVinculo;
    
    public function index(){        
        $this->llenarLista();
        $objetos=['listaVinculo'=>$this->listaVinculo];
        return view('reportes.vacunacionempleados',$objetos);  
    }
    private function llenarLista()
    {
        $this->listaVinculo=Vinculou::orderBy('t_vinculo','asc')->get();
        if(auth()->user()->b_estudiantes==1){
            $this->listaVinculo=Vinculou::where('n_idvinculou','=',Config::get('pregunta.n_idestudiante'))->orderBy('t_vinculo','asc')->get();            
        }
    }
    
    public function generarExcelVacunacion ()
    {     
        $sql="SELECT U.T_IDSIGAA ID
                    ,SPRIDEN_PIDM PIDM
                    ,SPRIDEN_FIRST_NAME||' '|| SPRIDEN_MI||' '||SPRIDEN_LAST_NAME NOMBRE_ID
                    ,U.C_CODTIPO TIPO_DOC
                    ,U.T_DOCUMENTO DOCUMENTO
                    ,(SELECT SPBPERS_SEX FROM SPBPERS WHERE SPBPERS_PIDM=SPRIDEN_PIDM) SEXO
                    ,(SELECT SPBPERS_BIRTH_DATE FROM SPBPERS WHERE SPBPERS_PIDM=SPRIDEN_PIDM) FEC_NACIMIENTO
                    ,(SELECT F_CALCULATE_AGE(NULL,SPBPERS_BIRTH_DATE,NULL) FROM SPBPERS WHERE SPBPERS_PIDM=SPRIDEN_PIDM) EDAD
                    ,NVL((SELECT C.GOREMAL_EMAIL_ADDRESS FROM GOREMAL C WHERE C.GOREMAL_PIDM=SPRIDEN_PIDM
                    AND C.GOREMAL_STATUS_IND = 'A' AND C.GOREMAL_PREFERRED_IND = 'Y'
                    AND LOWER(SUBSTR(C.GOREMAL_EMAIL_ADDRESS,INSTR(C.GOREMAL_EMAIL_ADDRESS,'@',1,1),127)) like '%upb.edu.co%'
                    AND ROWNUM=1),
                    NVL((SELECT C2.GOREMAL_EMAIL_ADDRESS FROM GOREMAL C2 WHERE C2.GOREMAL_PIDM=SPRIDEN_PIDM
                            AND C2.GOREMAL_STATUS_IND = 'A' AND LOWER(SUBSTR(C2.GOREMAL_EMAIL_ADDRESS,INSTR(C2.GOREMAL_EMAIL_ADDRESS,'@',1,1),127)) like '%upb.edu.co%'
                            AND ROWNUM = 1),
                        NVL((SELECT C.GOREMAL_EMAIL_ADDRESS FROM GOREMAL C WHERE C.GOREMAL_PIDM=SPRIDEN_PIDM
                            AND C.GOREMAL_STATUS_IND = 'A' AND C.GOREMAL_PREFERRED_IND = 'Y'
                            AND ROWNUM=1),
                            (SELECT C.GOREMAL_EMAIL_ADDRESS FROM GOREMAL C WHERE C.GOREMAL_PIDM=SPRIDEN_PIDM
                            AND C.GOREMAL_STATUS_IND = 'A' AND ROWNUM=1)
                            )
                        )
                    ) CORREO           
                    ,E.SECCIONAL    ,E.CENTRO_COSTO    ,E.DEPENDENCIA    ,E.TIPO_CONTRATO    ,E.TIPO_EMPLEADO    ,E.CARGO
                    ,F.UPDATED_AT FECHA_ESTADO
                    ,F.T_VACUNA
                    ,F.T_ACTIVO
                FROM UPB_COVID.VACUNACION F,UPB_COVID.USERS U,SPRIDEN
                ,(SELECT A.ID_BANNER ID
                ,DECODE(SUBSTR(B.EMPRESA,2,1),'M','Medellín','B','Bucaramanga','T','Montería','P','Palmira','C','Clínica','D','Bogotá') SECCIONAL
                ,(SELECT CC.NOMBRE_CENTRO_COSTO FROM CENTRO_COSTO@ICEBANDBL CC WHERE CC.CENTRO_COSTO = B.CENTRO_COSTO) CENTRO_COSTO
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
                                                                  ,(SELECT MAX(B2.FECHA_INGRESO) FROM EMPLEADO@ICEBANDBL B2 WHERE B2.NIT=B3.NIT))
                                      AND B3.NIT = B.NIT))) E
                ,UPB_COVID.sedes s
                WHERE U.N_IDUSUARIO = F.N_IDUSUARIO    AND u.n_idsede=s.n_idsede   AND SPRIDEN_PIDM = U.T_IDSIGAA
                    AND SPRIDEN_CHANGE_IND IS NULL       AND U.T_SIGAA = 'SI'       AND F.T_ACTIVO = 'SI'   AND SPRIDEN_PIDM = E.ID(+)";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sql.=" AND s.n_idciudad=".$idCiudad; 
        }
        if(request('n_idvinculou')!=null){ $sql.=" AND u.n_idvinculou=".request('n_idvinculou');  }        
        if(request('documento')!=null){ $sql.=" AND u.t_documento like '%".request('documento')."%'"; }
        if(auth()->user()->b_estudiantes==1){ $sql.=" AND u.n_idvinculou=".Config::get('pregunta.n_idestudiante'); }            
        $registros = DB::select($sql);            
        return Excel::download(new ReporteVacunacionExport($registros), 'REPORTE_VACUNACION.xlsx');
    }

}
