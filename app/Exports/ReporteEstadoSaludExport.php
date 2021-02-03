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


class ReporteEstadoSaludExport implements FromCollection,WithHeadings, WithColumnFormatting
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
            'ID','FECHA','ID_SIGAA','DOCUMENTO','NOMBRE','APELLIDOS','VINCULO','CIUDAD',
            'CONSENTIMIENTO','PESO','TALLA','FUMA','CIGARRILLOS_DIA','HIPERTENSION','MEDICAMENTO_HIPERTENSION',
            'DIABETES','MEDICAMENTO_DIABETES','CORAZON','ENFERMEDAD_CORAZON','PULMONAR','ENFERMEDAD_PULMONAR',
            'MEDICAMENTO_DEFENSAS_BAJAS','CUALES_MEDICAMENTOS_DEFENSAS','INMUNODEFICIENCIA',            
            'CANCER','QUIMIOTERAPIA','CONVIVE_MAYOR','CONVIVE_DEFENSAS_BAJAS','CONVIVE_PULMONAR','CONVIVE_OTRAS','CONVIVE_CUAL_OTRAS',
            'FORMULARIO_ACTIVO','SEMAFORO'];
    }
    
    // Set Date Format
    public function columnFormats(): array
    {
        return [
        /*'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,*/        ];
    }
}
