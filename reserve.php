<?php

session_start();

require_once 'includes/get_date.inc.php';

if(isset($_GET['id']) && isset($_SESSION['email']) && $_SESSION['uprawnienia']='czytelnik') {
    
    $id = $_GET['id'];
    $id_n = $id;
    $email = $_SESSION['email'];

    if(strlen($id)==1){
        $id_n = '0'.$id;
    }

    try {
        $conn = mysqli_connect('localhost', 'root', '', 'library');

        $conn->query('SET GLOBAL event_scheduler = ON');
        $conn->query("UPDATE egzemplarz SET czy_wyp=1 WHERE id_egzemplarza='$id_n'");
        $conn->query("INSERT INTO rezerwacja VALUES(NULL, '$email', '$id', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP + INTERVAL 1 DAY)");
        $conn->query("CREATE EVENT reservation_".$id." ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 2 MINUTE DO UPDATE egzemplarz SET czy_wyp=0 WHERE id_egzemplarza='$id'");
        
        $_SESSION['reserve-feedback'] = '<div class="alert alert-success mt-2">Rezerwacja przebiegła pomyślnie</div>';
        header("Location: katalog.php");

    } catch (Exception $e) {
            $_SESSION['reserve-feedback'] = '<div class="alert alert-danger mt-2">'.$e->getMessage().'</div>';
            header("Location: katalog.php");
    }

} else {
    header('Location: katalog.php');
}