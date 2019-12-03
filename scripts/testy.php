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
                        <td>3</td><td>Carnilla</td>
                    </tr>
                    <tr>
                        <td>4</td><td>Daemon</td>
                    </tr>
                </tbody>
                </table>
            ';
            
            $data = [
                ["firstname" => "Mary", "lastname" => "Johnson", "age" => 25],
                ["firstname" => "Amanda", "lastname" => "Miller", "age" => 18],
                ["firstname" => "James", "lastname" => "Brown", "age" => 31],
                ["firstname" => "Patricia", "lastname" => "Williams", "age" => 7],
                ["firstname" => "Michael", "lastname" => "Davis", "age" => 43],
                ["firstname" => "Sarah", "lastname" => "Miller", "age" => 24],
                ["firstname" => "Patrick", "lastname" => "Miller", "age" => 27]
              ];

            header("Content-type: application/xls");
            header("Content-Disposition: attachment; filename=raport_testowy.xls");
    
            echo $test;