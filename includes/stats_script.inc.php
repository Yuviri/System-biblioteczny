<?php

require_once "autoloader.inc.php";

if (!isset($_POST['date'])) {
    header("Location: ../stats.php");
    exit();
}else {
    $staty = new Statistics;

    $date = $_POST['date'];


    if(strlen($date)<=10){
        $output = $staty->lend_stats($date);
        $output2 = $staty->return_stats($date);

        if(!$staty->get_flags()){
            $export_btn = 
            '<form action="includes/export.inc.php" class="text-center mb-5  mx-auto" method="get">
                <input type="hidden" name="date" value="'.$_POST['date'].'">
                <button type="submit" class="btn btn-success px-5 name="export">Eksport</button>
            </form>';
        } else {
            $export_btn = '';
        }
        

        $final = $output.$output2.$export_btn;

        echo($final);
    } else{
        echo("Podany dzień jest nieprawidłowy");
    }

    
}

