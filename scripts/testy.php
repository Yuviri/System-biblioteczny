<?php

require_once "../includes/autoloader.inc.php";
        $test='
            <table class="table" border="1">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Czytelnik</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td><td>Annażą</td>
                    </tr>
                    <tr>
                        <td>2</td><td>Bartek</td>
                    </tr>
                    <tr>
                        <td>3</td><td>Żeromiąś</td>
                    </tr>
                    <tr>
                        <td>4</td><td>Daemon</td>
                    </tr>
                </tbody>
                </table>
            ';
            

        //     mb_convert_encoding($test, 'UTF-16LE', 'UTF-8');
            $data = [
                ["firstname" => "Mary", "lastname" => "Johnson", "age" => 25],
                ["firstname" => "Amanda", "lastname" => "Miller", "age" => 18],
                ["firstname" => "James", "lastname" => "Brown", "age" => 31],
                ["firstname" => "Patricia", "lastname" => "Williams", "age" => 7],
                ["firstname" => "Michael", "lastname" => "Davis", "age" => 43],
                ["firstname" => "Sarah", "lastname" => "Miller", "age" => 24],
                ["firstname" => "Gżegźdź", "lastname" => "Aę", "age" => 27]
              ];

        //     header("Content-type: application/xls");
        //     header("Content-Disposition: attachment; filename=raport_testowy.xls");
    
        //     echo($test) ;


        // $array = Array (
        //     0 => Array (
        //             0 => "How was the Food?",
        //             1 => 3,
        //             2 => 4 
        //     ),
        //     1 => Array (
        //             0 => "How was the first party of the semester?",
        //             1 => 2,
        //             2 => 4,
        //             3 => 0 
        //     ) 
    // );
    
    header("Content-Disposition: attachment; filename=\"demo.xls\"");
    header("Content-Type: application/vnd.ms-excel;");
    header("Pragma: no-cache");
    header("Expires: 0");
   

    // testy headerów

    // $wyp = Array(0 => "Wypożyczenie");
    // $headers = Array(0 => "Name", 1 => "Surname", 2 => "Age");

    // $final_array = Array();
    // $strArray = explode(',', $string);
    // foreach ($strArray as $value)
    // $final_array [] = iconv('UTF-8', 'Windows-1250', $value);



    // $out = fopen("php://output", 'w');
    
    // fputcsv($out, $wyp, "\t");
    // fputcsv($out, $headers, "\t");
    // foreach ($final_array as $d)
    // {
    //     fputcsv($out, $d,"\t");
    // }
    // fclose($out);


    // header("Content-Type:   application/vnd.ms-excel");
    // header("Content-Disposition: attachment; filename=czlonkowie_wspierajacy.csv");
    

    
    // Działa

    echo chr(0xEF) . chr(0xBB) . chr(0xBF);   
    echo "\r\n\r\n";  
    $csv = iconv('UTF-8', 'Windows-1250', $test);
    echo $csv;