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


class ConsultaFormularioExport implements FromCollection,WithHeadings, WithColumnFormatting
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
        return [
            'ID','FECHA','NOMBRE','APELLIDOS','TIPO','CIUDAD','SEDE',
            'CONSENTIMIENTO','IR_HOY_UPB','SITIOS','ACTIVIDADES',
            'PRESENTA_FIEBRE','DIAS_FIEBRE','DOLOR_GARGANTA',
            'MALESTAR_GENERAL','SECRECION_NASAL',
            'DIFICULTAD_RESPIRAR','TOS_SECA','PERSONAL_SALUD','CONTACTO_PERSONA_COVID',
            'FECHA_ULTIMO_CONTACTO','REALIZO_VIAJE_ULT_DIAS','FEC_ULTIMO_VIAJE'
            ,'CREACION','ACTUALIZO'];
    }
    // Set Date Format
    public function columnFormats(): array
    {
        return [
        /*'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,*/        ];
    }

}
