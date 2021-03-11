<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Vinculou;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteEstadoSaludDatosExport;
use DB;
use Validator;
use Config;


class ReporteEstadoSaludDatosController extends Controller
{

    private $listaSeccional;
    private $listaVinculo;
    
    public function index(){        
        $this->llenarLista();
        $objetos=['listaVinculo'=>$this->listaVinculo];
        return view('reportes.estadosaluddatos',$objetos);  
    }
    private function llenarLista()
    {
        $this->listaVinculo=Vinculou::orderBy('t_vinculo','asc')->get();
        if(auth()->user()->b_estudiantes==1){
            $this->listaVinculo=Vinculou::where('n_idvinculou','=',Config::get('pregunta.n_idestudiante'))->orderBy('t_vinculo','asc')->get();            
        }
    }

    // private function llenarLista()
    // {
    //     $this->listaSeccional=array('M'=>'Medellin','B'=>'Bucaramanga','T'=>'Montería','P'=>'Palmira','C'=>'Clínica','D'=>'Bogotá');        
    // }
    
    public function generarExcelEstadoSaludDatos ()
    {
        //$validator = Validator::make(request()->all(), ['id_empresa' => 'required',]);
        //if ($validator->fails()){ return redirect('estado/salud')->withErrors($validator)->withInput(); }

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
            ,(SELECT (SELECT STVCAMP_DESC FROM STVCAMP WHERE STVCAMP_CODE = E1.SGBSTDN_CAMP_CODE)
                FROM SGBSTDN E1
            WHERE E1.SGBSTDN_PIDM=SPRIDEN_PIDM
                AND E1.SGBSTDN_TERM_CODE_EFF=(SELECT MAX(E2.SGBSTDN_TERM_CODE_EFF) FROM SGBSTDN E2
                                                WHERE E2.SGBSTDN_PIDM=SPRIDEN_PIDM
                                                AND (E2.SGBSTDN_TERM_CODE_EFF LIKE '%10' OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%20'
                                                    OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%41' OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%42'))) CAMPUS
            ,(SELECT E1.SGBSTDN_PROGRAM_1
                FROM SGBSTDN E1
            WHERE E1.SGBSTDN_PIDM=SPRIDEN_PIDM
                AND E1.SGBSTDN_TERM_CODE_EFF=(SELECT MAX(E2.SGBSTDN_TERM_CODE_EFF) FROM SGBSTDN E2
                                                WHERE E2.SGBSTDN_PIDM=SPRIDEN_PIDM
                                                AND (E2.SGBSTDN_TERM_CODE_EFF LIKE '%10' OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%20'
                                                    OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%41' OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%42'))) PROGRAMA
            ,(SELECT (SELECT SMRPRLE_PROGRAM_DESC FROM SMRPRLE WHERE SMRPRLE_PROGRAM=E1.SGBSTDN_PROGRAM_1)
                FROM SGBSTDN E1
            WHERE E1.SGBSTDN_PIDM=SPRIDEN_PIDM
                AND E1.SGBSTDN_TERM_CODE_EFF=(SELECT MAX(E2.SGBSTDN_TERM_CODE_EFF) FROM SGBSTDN E2
                                                WHERE E2.SGBSTDN_PIDM=SPRIDEN_PIDM
                                                AND (E2.SGBSTDN_TERM_CODE_EFF LIKE '%10' OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%20'
                                                    OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%41' OR E2.SGBSTDN_TERM_CODE_EFF LIKE '%42'))) DESC_PROGRAMA
            ,E.SECCIONAL    ,E.CENTRO_COSTO    ,E.DEPENDENCIA    ,E.TIPO_CONTRATO    ,E.TIPO_EMPLEADO    ,E.CARGO
            ,DECODE(F.N_SEMAFORO,1,'SI','NO') TIENE_INGRESO
            ,F.UPDATED_AT FECHA_ESTADO
            ,F.T_CONSENTIMIENTO
            ,F.N_PESO
            ,F.N_TALLA
            ,F.T_FUMA
            ,F.N_CIGARRILLOS_DIA
            ,F.T_HIPERTENSION
            ,F.T_MEDICAMENTO_HIPERTENSION
            ,F.T_DIABETES
            ,F.T_MEDICAMENTO_DIABETES
            ,F.T_CORAZON
            ,F.T_ENFERMEDAD_CORAZON
            ,F.T_PULMONAR
            ,F.T_ENFERMEDAD_PULMONAR
            ,F.T_MEDICAMENTO_DEFENSAS_BAJAS
            ,F.T_CUALES_MED_DEFENSAS_BAJAS
            ,F.T_INMUNODEFICIENCIA
            ,F.T_CANCER
            ,F.T_QUIMIOTERAPIA_CANCER
            ,F.T_CONVIVE_MAYOR
            ,F.T_CONVIVE_BAJAS_DEFENSAS
            ,F.T_CONVIVE_PULMONAR
            ,F.T_CONVIVE_CANCER
            ,F.T_CONVIVE_OTRAS
            ,F.T_CONVIVE_CUAL
            ,F.T_ACTIVO
            ,DECODE(F.N_SEMAFORO,1,'VERDE',2,'AMARILLO','ROJO') SEMAFORO
     FROM UPB_COVID.FORMULARIO_COMORBILIDAD F,UPB_COVID.USERS U,SPRIDEN
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
            AND SPRIDEN_CHANGE_IND IS NULL       AND U.T_SIGAA = 'SI'       AND F.T_ACTIVO = 'SI'   AND SPRIDEN_PIDM = E.ID(+) ";

        if(request('todas')==null){
            $idCiudad=(auth()->user()->n_idciudad!=null)? auth()->user()->n_idciudad : 0 ;            
            $sql.=" AND s.n_idciudad=".$idCiudad; 
        }
        if(request('n_idvinculou')!=null){ $sql.=" AND u.n_idvinculou=".request('n_idvinculou');  }
        if(auth()->user()->b_estudiantes==1){ $sql.=" AND u.n_idvinculou=".Config::get('pregunta.n_idestudiante'); }    
        
        $registros = DB::select($sql);    
        //dd(count($registros));
        return Excel::download(new ReporteEstadoSaludDatosExport($registros), 'REPORTE_ESTADO_SALUD_DATOS.xlsx');
    }
    

}
