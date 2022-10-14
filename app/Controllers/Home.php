<?php

namespace App\Controllers;

use App\Models\ReporteModel;
use  PhpOffice\PhpSpreadsheet\Spreadsheet;
use  PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use  PhpOffice\PhpSpreadsheet\IOFactory;
use DateTime;

class Home extends BaseController
{
    public function index()
    {
        // $a = [
        //     "uno" => 1,
        //     "dos" => 2,
        //     "tres" => 3,
        //     "diecisiete" => 17
        // ];

        // foreach ($a as $k => $v) {
        //     echo $k . $v;
        // }
        // $rand = range(1, 20);
        // shuffle($rand);
        // var_dump(json_encode($this->generate_array_hours()));
        foreach ($this->generate_array_hours() as $key => $value) {
            echo $value . '<br>';
        }
    }


    /**
     * begin::funciones para agregar minutos de retraso a marcado
     */

    public function generate_array_hours()
    {
        // genera un array de horas

        $array = [];
        $array_numbers = $this->genera_array_numbers(120, 20);
        foreach ($array_numbers as $key => $value) {
            $array =  array_merge($array, [$this->add_minutes($value)]);
        }
        return $array;
    }

    public function add_minutes($minute)
    {
        // añade minutos a una hora

        $hour = '08:00:00';
        $new_hour = strtotime("+" . $minute . " minute", strtotime($hour)); // add minute
        $new_hour = strtotime("+" . rand(0, 59) . " second", $new_hour); // add seconds
        // echo date('h:i:s', $new_hour) . '<br>';
        return date('h:i:s', $new_hour);
    }

    public function genera_array_numbers($minutes_delay, $number_business_days)
    {
        // genera un array de numeros random apartir de los min atrasos

        $rand = range(1, $number_business_days); // genera un rango de numeros
        shuffle($rand); // mezcla el array
        $j = $minutes_delay;
        $array = [];
        $sum = 0;
        $minutes_delay = $j;
        for ($i = 0; $i < $number_business_days; $i++) {
            $ran =  rand(0, 17);
            if ($sum + $ran < $minutes_delay) {
                $sum += $ran;
                $array = array_merge($array, [$ran]);
            } else if ($sum != $j) {
                $array = array_merge($array, [$j - $sum]);
                $sum = $j;
            } else {
                $array = array_merge($array, [rand(-5, 0)]);
            }
        }
        shuffle($array);
        return $array;
    }

    /**
     * end::funciones para agregar minutos de retraso a marcado
     */


    /**
     * begin::funciones para fecha
     */

    public function get_if_business_day($date = null)
    {
        //si el dia es habil
        $daySig = date("D", strtotime($date));
        if (!($daySig === 'Sun' || $daySig === 'Sat')) {
            return true;
        } else {
            return false;
        }
    }

    public function get_number_days_month($date = null)
    {
        // numero de dias de un mes
        $f1 = new DateTime(date('Y-m-t', strtotime($date))); // ultima fecha del mes
        $f2 = new DateTime(date('Y-m-00', strtotime($date))); //primer dia del mes menos 1
        return $f1->diff($f2)->days; // # dias 
    }

    public function get_number_days_business_month($get_date = null)
    {
        # de dias habiles de un mes
        $cont = 0;
        $number_days_month = $this->get_number_days_month($get_date); // #dias
        $date = date('Y-m-01', strtotime($get_date));
        for ($i = 1; $i <= $number_days_month; $i++) {
            !$this->get_if_business_day($date) ?: $cont++;
            $date = date('Y-m-d', strtotime("+1 day", strtotime($date))); // ++day
        }
        return $cont;
    }

    public function add_moth_date($date = null)
    {
        // incrementa un mes ala fecha actual
        return date("d-m-Y", strtotime(date('Y-m-d', strtotime($date)) . "+ 1 month"));
    }


    /**
     * end::funciones para fecha
     */
}
