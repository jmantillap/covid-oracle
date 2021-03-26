<?php
namespace App\Utils;

use Log;
use Exception;
use Config;

class UtilFechas {


    public static function getFechaEspanol($date)
    {
        $fechaformulario=strtotime($date);
        $mes=date("n", $fechaformulario);
        $diasemana=date("w", $fechaformulario);
        $dia=date("j", $fechaformulario);
        $year=date("Y", $fechaformulario);

        switch ($mes) {
            case "1":
                $elmes="Enero";
                break;
            case "2":
                $elmes="Febrero";
                break;
            case "3":
                $elmes="Marzo";
                break;
            case "4":
                $elmes="Abril";
                break;
            case "5":
                $elmes="Mayo";
                break;
            case "6":
                $elmes="Junio";
                break;
            case "7":
                $elmes="Julio";
                break;
            case "8":
                $elmes="Agosto";
                break;
            case "9":
                $elmes="Septiembre";
                break;
            case "10":
                $elmes="Octubre";
                break;
            case "11":
                $elmes="Noviembre";
                break;
            case "12":
                $elmes="Diciembre";
                break;                
        }

        switch ($diasemana) {
            case "0":
                $eldia="Domingo";
                break;
            case "1":
                $eldia="Lunes";
                break;
            case "2":
                $eldia="Martes";
                break;
            case "3":
                $eldia="Miércoles";
                break;
            case "4":
                $eldia="Jueves";
                break;
            case "5":
                $eldia="Viernes";
                break;
                case "6":
            $eldia="Sábado";
                break;
        }

        return $eldia.", ".$dia." de ".$elmes." de ".$year;
    }

}