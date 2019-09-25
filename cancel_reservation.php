<?php

session_start();

require_once 'includes/get_date.inc.php';

if(isset($_GET['idr']) && isset($_SESSION['email']) && $_SESSION['uprawnienia']='czytelnik') {
    
    $idr = $_GET['idr'];
    $ide = $_GET['ide'];



    try {
        
        $conn = mysqli_connect('localhost', 'root', '', 'library');

        $conn->query("DELETE FROM rezerwacja WHERE id_rez='$idr'");
        $conn->query("UPDATE egzemplarz SET czy_wyp=0 WHERE id_egzemplarza='$ide'");
        $conn->query("DROP EVENT IF EXISTS reservation_".$ide.";");
        


        $_SESSION['cancel-feedback'] = '<div class="alert alert-success mt-2">Anulowano rezerwację</div>';
        header("Location: user_lends.php");

    } catch (Exception $e) {
            $_SESSION['cancel-feedback'] = '<div class="alert alert-danger mt-2">'.$e->getMessage().'</div>';
            header("Location: user_lends.php");
    }

    $conn->close();

} else {
    header('Location: katalog.php');
}

        