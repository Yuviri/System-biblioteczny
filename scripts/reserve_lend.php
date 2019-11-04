<?php

session_start();

require_once '../includes/get_date.inc.php';
require_once '../includes/autoloader.inc.php';

if(!isset($_POST['reservation'])){
    header("Location: ../forms/reserve_lend_form.php");
} else {
    $id = $_POST['reservation'];
    $od = $_POST['od'];
    $do = $_POST['do'];
    $pracownik = $_SESSION['id'];
    
    $conn = mysqli_connect('localhost', 'root', '', 'library');
    
    $sql1 = "SELECT czytelnik, egzemplarz FROM rezerwacja WHERE id_rez='$id'";
    if(!$result1=$conn->query($sql1)){
        echo 'Błąd pierwszego zapytania!';
        exit();
    }

    while ($row = mysqli_fetch_assoc($result1)) {
        $czytelnik = $row['czytelnik'];
        $egzemplarz = $row['egzemplarz'];
        if(strlen($egzemplarz)==1){
            $ide = '0'.$egzemplarz;
        } else {
            $ide = $egzemplarz;
        }
    }

    $sql2 = "UPDATE rezerwacja SET status='zakonczona' WHERE id_rez='$id'";
    $sql3 = "INSERT INTO wypozyczenie VALUES(NULL, '$czytelnik', '$pracownik', '$egzemplarz', '$od', '$do', NULL)";
    $sql4 = "DROP EVENT IF EXISTS reservation_".$ide.";";

    if(!$result2=$conn->query($sql2)){
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Błąd drugiego zapytania</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }

    if(!$result3=$conn->query($sql3)){
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Błąd trzeciego zapytania</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }

    if(!$result4=$conn->query($sql4)){
        $_SESSION['lendr-err'] = '<div class="alert alert-danger">Błąd czwartego zapytania</div>';
        header("Location: ../reserve_lend_form.php");
        exit();
    }

    $_SESSION['lendr-success'] = '<div class="alert alert-success">Pomyślnie wypożyczono zarezerwowany egzemplarz</div>';
    header("Location: ../reserve_lend_form.php");

    $conn->close();
    //Dodawanie w klasie (do poprawy)

    // $lend = new Reshandler($id, $_SESSION['id']);
    // $lend->get_reservation_data();
    // if($lend->lend()){
    //     $_SESSION['lendr-success'] = '<div class="alert alert-success">Pomyślnie wypożyczono zarezerwowany egzemplarz</div>';
    //     header("Location: ../reserve_lend_form.php");
    // } 
    // else {
    //     $error_message = $lend->getError();
    //     $_SESSION['lendr-err'] = '<div class="alert alert-danger">Błąd: '.$error_message.'</div>';
    //     header("Location: ../reserve_lend_form.php");
    // }

}