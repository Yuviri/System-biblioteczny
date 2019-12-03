<?php

require_once "autoloader.inc.php";

if (!isset($_POST['date'])) {
    header("Location: ../stats.php");
    exit();
}else {
    $staty = new Statistics;

    if(strlen($_POST['date'])==10){
        $output = $staty->lend_stats($_POST['date']);
        $output2 = $staty->return_stats($_POST['date']);
        $export_btn = 
        '<form action="includes/export.inc.php" class="text-center mb-5" method="get">
            <input type="hidden" name="date" value="'.$_POST['date'].'">
            <button type="submit" class="btn btn-success px-5" name="export">Eksport</button>
        </form>';

        $final = $output.$output2.$export_btn;

        echo ($final);
    } else if (strlen($_POST['date'])<10) {
        $output = $staty->monthly_lends($_POST['date']);
        $output2 = $staty->monthly_returns($_POST['date']);
        $export_btn = 
        '<form action="includes/export.inc.php" class="text-center mb-5" method="get">
            <input type="hidden" name="date" value="'.$_POST['date'].'">
            <button type="submit" class="btn btn-success px-5" name="export">Eksport</button>
        </form>';

        $final = $output.$output2.$export_btn;

        echo ($final);
    } else {
        echo ("Podany dzień jest nieprawidłowy");
    }

    
}

