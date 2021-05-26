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

class ReporteVacunacionExport implements FromCollection,WithHeadings, WithColumnFormatting
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
        return ['ID','PIDM','NOMBRE_ID','TIPO_DOC','DOCUMENTO','SEXO','FEC_NACIMIENTO','EDAD','CORREO','SECCIONAL','CENTRO_COSTO',
                'DEPENDENCIA','TIPO_CONTRATO','TIPO_EMPLEADO','CARGO','FECHA_ESTADO','T_VACUNA','T_ACTIVO'];
    }
    public function columnFormats(): array
    {
        return [
        /*'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,*/        ];
    }

}
