<?php

session_start();

require_once '../includes/autoloader.inc.php';

if(!isset($_POST['reservation'])){
    header("Location: ../reserve_lend_form.php");
} else {
    $id = $_POST['reservation'];
    $od = $_POST['od'];
    $do = $_POST['do'];
    $pracownik = $_SESSION['email'];

    if (!filter_input(INPUT_POST, "reservation", FILTER_VALIDATE_INT)) {
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Numer rezerwacji musi być liczbą całkowitą</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }
    
    require_once "../database.php";
    
    $sql1 = "SELECT czytelnik, egzemplarz FROM rezerwacja WHERE id_rez='$id' AND status='aktywna'";
    $check = $db->query($sql1);
    
    if(!$check){
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Nie znaleziono podanej rezerwacji</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }

    $result = $check->fetchAll();

    foreach ($result as $key => $value) {
        $czytelnik = $value['czytelnik'];
        $egzemplarz = $value['egzemplarz'];
    }

    $sql2 = "UPDATE rezerwacja SET status='zakonczona' WHERE id_rez=?";
    $sql3 = "INSERT INTO wypozyczenie VALUES(?, ?, ?, ?, ?, ?, ?)";

    $upd = $db->prepare($sql2);

    if(!$upd->execute([$id])){
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Błąd zmiany statusu rezerwacji</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }

    $ins = $db->prepare($sql3);

    if(!$ins->execute([NULL, $czytelnik, $pracownik, $egzemplarz, $od, $do, $NULL])){
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Błąd obsługi wypożyczenia</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }


    $_SESSION['lendr-success'] = '<div class="alert alert-success">Pomyślnie wypożyczono zarezerwowany egzemplarz</div>';
    header("Location: ../reserve_lend_form.php");


}