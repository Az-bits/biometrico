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
        $reporte = new ReporteModel();
        $data = $reporte->findAll();
        // var_dump($data);
        $obs = [
            0 => 'DECLARATORIA COMISION', 1 => 'VACACION', 2 => 'CUMPLEAÑOS', 3 => 'BAJA MEDICA'
        ];

        $spreadsheet = new SpreadSheet();
        $spreadsheet->getProperties()->setCreator('Marko Robles')->setTitle('Mi Excel');
        $spreadsheet->setActiveSheetIndex(0);
        $hojaActiva = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma'); //cambia fuente
        $spreadsheet->getDefaultStyle()->getFont()->setSize(15);
        // $hojaActiva->getColumnDimension('A')->setWidth(40);
        // $hojaActiva->getColumnDimension('B')->setWidth(20);
        // $spreadsheet->getActiveSheet()->getDefaultColumnDimension('A1')->setWidth(400, 'pt');
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $hojaActiva
            ->setCellValue('A1', 'CI')
            ->setCellValue('B1', 'NOMBRE')
            ->setCellValue('C1', 'PATERNO')
            ->setCellValue('D1', 'FECHA')
            ->setCellValue('E1', 'EM')
            ->setCellValue('F1', 'SM')
            ->setCellValue('G1', 'ET')
            ->setCellValue('H1', 'ST');
        $i = 2;
        foreach ($data as $key => $d) {
            $hojaActiva
                ->setCellValue('A' . $i, $d['ci'])
                ->setCellValue('B' . $i, $d['nombre'])
                ->setCellValue('C' . $i, $d['paterno'])
                ->setCellValue('D' . $i, $d['fecha']);
            if (!$d['obs']) {
                $hojaActiva
                    ->setCellValue('E' . $i, $d['em'])
                    ->setCellValue('F' . $i, $d['sm'])
                    ->setCellValue('G' . $i, $d['et'])
                    ->setCellValue('H' . $i, $d['st']);
            } elseif ($d['obs'] === $obs[2]) {
                $hojaActiva
                    ->setCellValue('E' . $i, $d['em'])
                    ->setCellValue('F' . $i, $d['sm'])
                    ->setCellValue('G' . $i, $d['obs'])
                    ->setCellValue('H' . $i, $d['obs']);
            } else {
                $hojaActiva
                    ->setCellValue('E' . $i, $d['obs'])
                    ->setCellValue('F' . $i, $d['obs'])
                    ->setCellValue('G' . $i, $d['obs'])
                    ->setCellValue('H' . $i, $d['obs']);
            }
            $i++;
        }
        // $hojaActiva->setCellValue('B2', 1234.1234);
        // $hojaActiva->setCellValue('C1', 'Marko Robles')->setCellValue('D1', 'CDP');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="myfile.xls"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
        // $writer = new Xlsx($spreadsheet);
        // $writer->save('Excel/My excel.xlsx');
        // return view('welcome_message');
    }
    public function test($hora = '08:05:00', $fecha = '12-06-2022')
    {
        $reporte = new ReporteModel();
        $data = $reporte->orderBy('fecha')->where('ci', '22222222')->findAll();
        $minAtraso = 120;
        $mAtraso = $minAtraso;
        $sum = 0;
        // for ($i = 0; $i < 17; $i++) {
        //     $data[rand(0, 17)];
        // }
        // var_dump($data[rand(0, 17)]['em']);
        $i = 1;
        foreach ($data as $key => $d) {
            if ($minAtraso > 0 && $minAtraso <= $mAtraso) {
                if ($d['em'] !== null) {
                    $min = rand(0, 14);
                    $sum = $sum + $min;
                    $minAtraso = $minAtraso - $min;
                    $this->addMinutes($d['fecha'], $d['em'], $min, $i);
                    $i++;
                }
            } else {
                if ($minAtraso > 0) {
                    $minAtraso = $mAtraso - $sum;
                }
                $this->addMinutes($d['fecha'], $d['em'], $minAtraso, $i);
                $minAtraso = 0;
                $i++;

                // echo 'total ' . (($mAtraso - $sum) + $sum);
            }
        }
        echo $sum;
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
    public function randomNumber()
    {
        /**Números Random  */
        $rand = range(1, 22);
        shuffle($rand);
        foreach ($rand as $val) {
            echo $val . ', ';
        }
        /** */
        echo '<br>';
        $j = 30;
        $array = [];
        $sum = 0;
        $minAtraso = $j;
        for ($i = 0; $i < 22; $i++) {
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
