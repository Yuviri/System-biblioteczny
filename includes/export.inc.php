<?php

require_once "autoloader.inc.php";

if(!isset($_GET['date'])){
    header("Location: ../stats.php");
    exit();
} else {

    $staty = new Statistics;

    if(strlen($_GET['date'])==10){
        $output = $staty->lend_stats($_GET['date']);
        $output2 = $staty->return_stats($_GET['date']);
        $export_btn = 
        '<form action="includes/export.inc.php" class="text-center" method="post">
            <button type="submit" class="btn btn-success">Eksport</button>
        </form>';

        $final = $output.$output2;

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=raport_".$_GET['date'].".xls");

        echo ($final);
    } else {
        $output = $staty->monthly_lends($_GET['date']);
        $output2 = $staty->monthly_returns($_GET['date']);
        $export_btn = 
        '<form action="includes/export.inc.php" class="text-center mb-5" method="post">
            <button type="submit" class="btn btn-success px-5" name="export">Eksport</button>
        </form>';

        $final = $output."<br><br>".$output2;

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=raport_".$$_GET['date'].".xls");

        echo ($final);
    }

}