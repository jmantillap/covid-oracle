<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ReporteEstadoSaludDatosExport implements FromCollection,WithHeadings, WithColumnFormatting
{
    use Exportable;
    protected $registros;
    
    public function __construct($registros)
    {
        $this->registros = $registros;        
    }

    public function collection()
    {        
        $listaColleccion = collect($this->registros);
        return $listaColleccion;
    }

    public function headings(): array
    {
        return ['ID','PIDM','NOMBRE_ID','TIPO_DOC','DOCUMENTO','SEXO','FEC_NACIMIENTO','EDAD','CORREO','CAMPUS','PROGRAMA','DESC_PROGRAMA','SECCIONAL','CENTRO_COSTO',
                'DEPENDENCIA','TIPO_CONTRATO','TIPO_EMPLEADO','CARGO','TIENE_INGRESO','FECHA_ESTADO','T_CONSENTIMIENTO','N_PESO','N_TALLA','T_FUMA','N_CIGARRILLOS_DIA',
                'T_HIPERTENSION','T_MEDICAMENTO_HIPERTENSION','T_DIABETES','T_MEDICAMENTO_DIABETES','T_CORAZON','T_ENFERMEDAD_CORAZON','T_PULMONAR','T_ENFERMEDAD_PULMONAR',
                'T_MEDICAMENTO_DEFENSAS_BAJAS','T_CUALES_MED_DEFENSAS_BAJAS','T_INMUNODEFICIENCIA','T_CANCER','T_QUIMIOTERAPIA_CANCER','T_CONVIVE_MAYOR',
                'T_CONVIVE_BAJAS_DEFENSAS','T_CONVIVE_PULMONAR','T_CONVIVE_CANCER','T_CONVIVE_OTRAS','T_CONVIVE_CUAL','T_ACTIVO','SEMAFORO'];
    }
    public function columnFormats(): array
    {
        return [
        /*'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,*/        ];
    }

}
