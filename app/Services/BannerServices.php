<?php
namespace App\Services;
use DB;
use Log;
use Exception;

/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06-16
 */
class BannerServices {

    public function __construct()  
    {        
    }

    public static function getUsuarioBanner($pidmCeros)
    {
        $sql=Self::getSqlBase(). " AND SPRIDEN_ID=NVL(:PIDM_COVID,'-99999') ";        
        try {
            $registros = collect(DB::select($sql,['PIDM_COVID' => $pidmCeros]))->first();        
        } catch (Exception $e) {
		    $registros = collect([]);
            Log::error($e);             
        }  	
        return $registros;
    }

    public static function getUsuarioBannerNroDocumento($numeroDocumento)
    {
        $sql=Self::getSqlBase(). " AND SZRIDEN_DOC_ID=NVL(:DOCUMENTO_COVID,'-99999') ";        
        $registros = collect(DB::select($sql,['DOCUMENTO_COVID' => $numeroDocumento]))->first();

        return $registros;
    }

    private static function getSqlBase(){
        $sql="SELECT DISTINCT SPRIDEN_PIDM pidm, SPRIDEN_ID id,    SZRIDEN_ADID_CODE tipo_documento, SZRIDEN_DOC_ID documento,
            (SPRIDEN_FIRST_NAME || ' ' || SPRIDEN_MI || ' ' || SPRIDEN_LAST_NAME) nombre_completo,  
            SPRIDEN_FIRST_NAME primer_nombre,    SPRIDEN_MI segundo_nombre,    SPRIDEN_LAST_NAME apellidos,
            GOREMAL_EMAIL_ADDRESS email,    SPRTELE_PHONE_AREA || SPRTELE_PHONE_NUMBER celular,
            NVL(DECODE (sprtele_phone_ext, NULL, NULL, 'ext: ' || sprtele_phone_Ext),'') telefono_completo,
            GOREMAL_EMAIL_ADDRESS correo
            /*,sprtele.**/
            FROM SPRIDEN JOIN SZRIDEN ON (SPRIDEN_PIDM = SZRIDEN_PIDM AND SZRIDEN_PRINCIPAL_IND = 'Y') left join
                goremal ON (SZRIDEN_PIDM = goremal_PIDM AND GOREMAL_STATUS_IND='A' AND GOREMAL_EMAL_CODE='UPB' ) LEFT JOIN
                sprtele ON (SZRIDEN_PIDM = sprtele_PIDM AND SPRTELE_TELE_CODE='TM')
            WHERE SPRIDEN_CHANGE_IND IS NULL 
                AND spriden_entity_ind = 'P' ";
        return $sql;
    }

    public static function getEdadUsuarioBanner($idAplicativoCovid)
    {
        $sql="SELECT BANINST1.F_CALCULATE_AGE(NULL,SPBPERS_BIRTH_DATE,NULL) edad
        FROM SPBPERS P INNER JOIN 
            SPRIDEN S ON (P.SPBPERS_PIDM=S.SPRIDEN_PIDM) INNER JOIN
            USERS U ON (S.SPRIDEN_ID=U.T_IDSIGAA) 
        WHERE S.SPRIDEN_CHANGE_IND IS NULL AND S.spriden_entity_ind = 'P'  
        /*AND P.SPBPERS_PIDM=:pidm AND P.SPBPERS_PIDM=:T_IDSIGAA   */ AND U.N_IDUSUARIO=:N_IDUSUARIO ";        
        $registro = collect(DB::select($sql,['N_IDUSUARIO' => $idAplicativoCovid]))->first();        
        if($registro==null) return 0;
        return $registro->edad;
    }

}
 /*$sql="SELECT DISTINCT SPRIDEN_PIDM pidm, SPRIDEN_ID id,    SZRIDEN_ADID_CODE tipo_documento, SZRIDEN_DOC_ID documento,
            (SPRIDEN_FIRST_NAME || ' ' || SPRIDEN_MI || ' ' || SPRIDEN_LAST_NAME) nombre_completo,  
            SPRIDEN_FIRST_NAME primer_nombre,    SPRIDEN_MI segundo_nombre,    SPRIDEN_LAST_NAME apellidos,
            GOREMAL_EMAIL_ADDRESS email,    SPRTELE_PHONE_AREA || SPRTELE_PHONE_NUMBER celular            
            FROM SPRIDEN JOIN SZRIDEN ON (SPRIDEN_PIDM = SZRIDEN_PIDM AND SZRIDEN_PRINCIPAL_IND = 'Y') left join
                goremal ON (SZRIDEN_PIDM = goremal_PIDM AND GOREMAL_STATUS_IND='A' AND GOREMAL_EMAL_CODE='UPB' ) LEFT JOIN
                sprtele ON (SZRIDEN_PIDM = sprtele_PIDM AND SPRTELE_TELE_CODE='TM')
            WHERE SPRIDEN_CHANGE_IND IS NULL 
                AND spriden_entity_ind = 'P'
                AND SPRIDEN_ID=NVL(:PIDM_COVID,'-99999') ";   */ 