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
        $this->randomNumber(null, null);
    }


    /**
     * begin::funciones para agregar minutos de retraso a marcado
     */
    public function randomNumber($minutes_delay, $number_business_days)
    {
        // genera un array de numeros random apartir de los min atrasos
        $rand = range(1, $number_business_days); // genera un rango de numeros
        shuffle($rand);
        foreach ($rand as $val) {
            echo $val . ', ';

            // $nHora = strtotime("+" . $val . " minute", strtotime($hourDefault));
            // echo date('h:i:s', $nHora) . '<br> ';
        }
        /** */
        echo '<br>';
        $j = $minutes_delay;
        $array = [];
        $sum = 0;
        $minutes_delay = $j;
        for ($i = 0; $i < $number_business_days; $i++) {
            $ran =  rand(0, 17);
            if ($sum + $ran < $minutes_delay) {
                $sum += $ran;
                $array = array_merge($array, [$ran]);
                echo $ran . ', ';
            } else if ($sum != $j) {
                $array = array_merge($array, [$j - $sum]);
                echo $j - $sum . ', ';
                $sum = $j;
            } else {
                $array = array_merge($array, [0]);
                echo 0 . ', ';
            }
        }

        echo '<br>';
        echo 'suma : ' .  $sum;
        echo '<br>';
        shuffle($array);
        echo '<br>';

        foreach ($array as $key => $a) {
            echo $a . ', ';
        }
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
