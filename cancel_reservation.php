<?php

session_start();


if(isset($_GET['idr']) && isset($_SESSION['email']) && $_SESSION['uprawnienia']='czytelnik') {
    
    $idr = $_GET['idr'];
    $ide = $_GET['ide'];

    require_once "database.php";

    try {
        
        $db->query("UPDATE rezerwacja SET status='anulowana' WHERE id_rez='$idr'");
        $db->query("UPDATE egzemplarz SET czy_wyp=0 WHERE id_egzemplarza='$ide'");

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

        