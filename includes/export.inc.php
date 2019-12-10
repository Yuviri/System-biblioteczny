<?php

require_once "autoloader.inc.php";

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if(!isset($_GET['date'])){
    header("Location: ../stats.php");
    exit();
} else {

    $staty = new Statistics;

    // Pobranie tablic z danymi do raportu

    $l_array = $staty->lend_export($_GET['date']);
    $r_array = $staty->return_export($_GET['date']);

    // Liczniki do pętli

    $n = 2;
    $x = 2;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Scalenie komórek do tytułów tabel

    $spreadsheet->getActiveSheet()->mergeCells('A1:D1');
    $spreadsheet->getActiveSheet()->mergeCells('G1:K1');
 
    // Tablice ze stylami komórek

    $styleHeaders = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => '95bae8',
            ],
        ],
    ];
    
    $styleData = [
        'font' => [
            'bold' => false,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'ffffff',
            ],
        ],
    ];


    // Nagłówki
    $sheet->setCellValue('A1', 'Wypożyczenia');
    $sheet->setCellValue('A2', '#');
    $sheet->setCellValue('B2', 'Czytelnik');
    $sheet->setCellValue('C2', 'Pracownik');
    $sheet->setCellValue('D2', 'Tytuł');

    
    $sheet->setCellValue('G1', 'Zwroty');
    $sheet->setCellValue('G2', '#');
    $sheet->setCellValue('H2', 'Czytelnik');
    $sheet->setCellValue('I2', 'Pracownik');
    $sheet->setCellValue('J2', 'Tytuł');
    $sheet->setCellValue('K2', 'Data wypożyczenia');


    // Wypełnianie tabel zawartością tablic

    foreach ($l_array as $key => $value) {

        $n = $n+1;
    
        $sheet->setCellValue('A'.$n, $value['id_wyp']);
        $sheet->setCellValue('B'.$n, $value['czytelnik']);
        $sheet->setCellValue('C'.$n, $value['imie'].' '.$value['nazwisko']);
        $sheet->setCellValue('D'.$n, $value['nazwa']);   
    }

    foreach ($r_array as $key => $value) {

        $x = $x+1;
    
        $sheet->setCellValue('G'.$x, $value['id_wyp']);
        $sheet->setCellValue('H'.$x, $value['czytelnik']);
        $sheet->setCellValue('I'.$x, $value['imie'].' '.$value['nazwisko']);
        $sheet->setCellValue('J'.$x, $value['nazwa']);   
        $sheet->setCellValue('K'.$x, $value['od']);  
    }

    // Aplikacja styli

    $spreadsheet->getActiveSheet()->getStyle("A1:D1")->applyFromArray($styleHeaders);
    $spreadsheet->getActiveSheet()->getStyle("A2:D2")->applyFromArray($styleHeaders);

    $spreadsheet->getActiveSheet()->getStyle("G1:K1")->applyFromArray($styleHeaders);
    $spreadsheet->getActiveSheet()->getStyle("G2:K2")->applyFromArray($styleHeaders);

    $spreadsheet->getActiveSheet()->getStyle("A3:A".$n)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("B3:B".$n)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("C3:C".$n)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("D3:D".$n)->applyFromArray($styleData);

    $spreadsheet->getActiveSheet()->getStyle("G3:G".$x)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("H3:H".$x)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("I3:I".$x)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("J3:J".$x)->applyFromArray($styleData);
    $spreadsheet->getActiveSheet()->getStyle("K3:K".$x)->applyFromArray($styleData);

    // Autoskalowanie kolumn

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);


    // Zapis do pliku

    $filename = 'raport_'.$_GET['date'];

    header("Content-Disposition: attachment; filename=$filename.xls");

    $writer = IOFactory::createWriter($spreadsheet, "Xlsx"); 
    $writer->save("php://output");




















}