<?php


require_once "../includes/autoloader.inc.php";
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$staty = new Statistics;

$date = '2019-12-01';


$l_array = $staty->lend_export($date);
$r_array = $staty->return_export($date);

$n = 2;



$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getActiveSheet()->mergeCells('A1:D1');

// tablica ze stylem do excela



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

foreach ($l_array as $key => $value) {

    $n = $n+1;

    $sheet->setCellValue('A'.$n, $value['id_wyp']);
    $sheet->setCellValue('B'.$n, $value['czytelnik']);
    $sheet->setCellValue('C'.$n, $value['imie'].' '.$value['nazwisko']);
    $sheet->setCellValue('D'.$n, $value['nazwa']);

    
}


$range = "A1:A".$n;
$spreadsheet->getActiveSheet()->getStyle("A1:D1")->applyFromArray($styleHeaders);
$spreadsheet->getActiveSheet()->getStyle("A2:D2")->applyFromArray($styleHeaders);

$spreadsheet->getActiveSheet()->getStyle("A3:A".$n)->applyFromArray($styleData);
$spreadsheet->getActiveSheet()->getStyle("B3:B".$n)->applyFromArray($styleData);
$spreadsheet->getActiveSheet()->getStyle("C3:C".$n)->applyFromArray($styleData);
$spreadsheet->getActiveSheet()->getStyle("D3:D".$n)->applyFromArray($styleData);


$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
// header("Content-type: application/xls");
header("Content-Disposition: attachment; filename=raport_testowy.xls");

$writer = IOFactory::createWriter($spreadsheet, "Xlsx"); //Xls is also possible
$writer->save("php://output");