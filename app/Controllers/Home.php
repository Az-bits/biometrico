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
    }
    public function test()
    {
        $reporte = new ReporteModel();
        $data = $reporte->orderBy('fecha')->where('ci', '22222222')->findAll();

        //min retrado
        $minAtraso = $data[0]['mr'];

        //cantidad dias habiles mes
        $cDiasHabiles = $this->getDiasHabiles($data);
        $mAtraso = $minAtraso;
        $sum = 0;
        // for ($i = 0; $i < 17; $i++) {
        //     $data[rand(0, 17)];
        // }
        // var_dump($data[rand(0, 17)]['em']);
        $i = 1;

        //min retraso formateados

        $minFormat = $this->getArrayHourFormated($minAtraso, $cDiasHabiles);

        // foreach ($data as $key => $d) {
        //     if ($minAtraso > 0 && $minAtraso <= $mAtraso) {
        //         if ($d['em'] !== null) {
        //             $min = rand(0, 14);
        //             $sum = $sum + $min;
        //             $minAtraso = $minAtraso - $min;
        //             $this->addMinutes($d['fecha'], $d['em'], $min, $i);
        //             $i++;
        //         }
        //     } else {
        //         if ($minAtraso > 0) {
        //             $minAtraso = $mAtraso - $sum;
        //         }
        //         $this->addMinutes($d['fecha'], $d['em'], $minAtraso, $i);
        //         $minAtraso = 0;
        //         $i++;

        //         // echo 'total ' . (($mAtraso - $sum) + $sum);
        //     }
        // }
        // echo $sum;
        // return view('welcome_message', $data = ['data' => $data]);
    }
    public function getArrayHourFormated($minAtraso, $cDiasHabiles)
    {
        $hours = [];
        $this->randomNumber($minAtraso, $cDiasHabiles);
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
    public function getDiasHabiles($data)
    {
        //cuantos dias habiles en el mes
        $i = 0;
        foreach ($data as $key => $value) {
            $daySig = date("D", strtotime($value['fecha']));
            if (!($daySig === 'Sun' || $daySig === 'Sat')) {
                $i++;
            }
        }
        return $i;
    }
}
