<?php

session_start();


if(isset($_GET['id']) && isset($_SESSION['email']) && $_SESSION['uprawnienia']==='U') {
    
    $id = $_GET['id'];
    $email = $_SESSION['email'];

    require_once "database.php";

    try {
 
        $db->query("UPDATE egzemplarz SET czy_wyp=1 WHERE id_egzemplarza='$id'");
        $db->query("INSERT INTO rezerwacja VALUES(NULL, '$email', '$id', 'aktywna', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP + INTERVAL 1 DAY)");
        


        $_SESSION['reserve-feedback'] = '<div class="alert alert-success mt-2">Rezerwacja przebiegła pomyślnie</div>';
        header("Location: katalog.php");

    } catch (Exception $e) {
            $_SESSION['reserve-feedback'] = '<div class="alert alert-danger mt-2">'.$e->getMessage().'</div>';
            header("Location: katalog.php");
    }

    $conn->close();

} else if (isset($_GET['id']) && isset($_SESSION['email']) && ($_SESSION['uprawnienia']==='P' || $_SESSION['uprawnienia']==="A")) {
    header("Location: katalog.php");
} else {
    header('Location: login_form.php?redirect');
}

        