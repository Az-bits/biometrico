<?php

namespace App\Controllers;

use DateTime;

class test extends BaseController
{
    public function test()
    {
    }
    public function getArrayHourFormated($minutes_delay, $number_business_days)
    {
        $hours = [];
        $this->randomNumber($minutes_delay, $number_business_days);
    }
    public function addMinutes($fechaEL = null, $hora = null, $min = null, $i)
    {
        $fecha = new DateTime($fechaEL);
        $day = date('d', strtotime($fecha->format('Y-m-d')));
        $daySig = date("D", strtotime($fechaEL));
        if ($hora !== null) {
            if (!($daySig === 'Sun' || $daySig === 'Sat')) {
                // echo '<br>' . $min . ' min ' . '<br>';
                $nHora = strtotime("+" . $min . " minute", strtotime($hora));
                $fHora = strtotime("+" . rand(0, 59) . " second", $nHora);
                echo $i . ' ' . date('h:i:s', $fHora) . ' ' . $day . '<br>';
            }
        }
    }

    public function randomNumber($minutes_delay, $number_business_days)
    {
        // genera un array de numeros random apartir de los min atrasos
        $rand = range(1, $number_business_days);
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

    public function asdf($minutes_delay, $number_business_days)
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
                $array = array_merge($array, [0]);
            }
        }
        return shuffle($array);
    }
}
