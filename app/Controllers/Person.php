<?php

namespace App\Controllers;

use DateTime;

class Person extends BaseController
{
    public function index()
    {
        $data = [
            'person' => [
                [
                    'ci' => '11111111',
                    'nombre'  => 'Sara',
                    'paterno'  => 'Ali',
                    'materno'  => 'Mamani',
                    'fecha' => '2017-01-03',
                    'em' => null,
                    'sm' => null,
                    'et' => null,
                    'st' => null,
                    'minRetraso' => 40
                ],

            ],

        ];
        $this->generateMarc($data['person']);
        // return view('welcome_message', $data);
    }
    public function generateMarc($data, $fecha = '01-01-2017')
    {
        // var_dump($data);
        $hEntrada = '08:05:00';
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
    public function extra()
    {
        $Days = [
            0 => 'Sun',
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat'
        ];
        // $ultimoDia = date('d', strtotime($fecha->format('Y-m-t')));

        // $mifecha = date('H:i:s', '18:00:00');
        // $NuevaFecha = strtotime('+10 minute', strtotime($mifecha));
        // // $NuevaFecha = strtotime('+18 minute', $NuevaFecha);
        // // $NuevaFecha = strtotime('+30 second', $NuevaFecha);
        // $NuevaFecha = date('H:i:s', $NuevaFecha);
        // echo $NuevaFecha;

        // $fecha = new DateTime($fecha);
        // $ultimoDia = date('D', strtotime($fecha->format('Y-m-t')));
        // echo $ultimoDia;

        // $ultimoDia = date("m", $fecha->format('Y-m-t'));
        // echo $ultimoDia;
        // $minAtraso = 120;
        // for ($i = 1; $i <= $ultimoDia; $i++) {
        //     echo $i . ' <br>';
        // }

        // $mifecha = new DateTime($hora);
        // $mifecha->modify('+' . rand(1, 5) . ' minute');
        // echo $mifecha->format('H:i:s');
        // echo 120 / 22;
        // echo rand(1, 5);

        // $day = date("l");
        // switch ($day) {
        //     case "Sunday":
        //         echo "Hoy es domingo";
        //         break;
        //     case "Monday":
        //         echo "Hoy es lunes";
        //         break;
        //     case "Tuesday":
        //         echo "Hoy es martes";
        //         break;
        //     case "Wednesday":
        //         echo "Hoy es miércoles";
        //         break;
        //     case "Thursday":
        //         echo "Hoy es jueves";
        //         break;
        //     case "Friday":
        //         echo "Hoy es viernes";
        //         break;
        //     case "Saturday":
        //         echo "Hoy es sábado";
        //         break;
        // }
        // echo $this->addMinutes();
    }
    public function randomNumber($minAtraso, $cDiasHabiles)
    {
        /** Números Random  */
        $hourDefault = '08:05:00';
        $rand = range(1, $cDiasHabiles);
        shuffle($rand);
        foreach ($rand as $val) {
            echo $val . ', ';

            // $nHora = strtotime("+" . $val . " minute", strtotime($hourDefault));
            // echo date('h:i:s', $nHora) . '<br> ';
        }
        /** */
        echo '<br>';
        $j = $minAtraso;
        $array = [];
        $sum = 0;
        $minAtraso = $j;
        for ($i = 0; $i < $cDiasHabiles; $i++) {
            $ran =  rand(0, 17);
            if ($sum + $ran < $minAtraso) {
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
}
