<?php

require_once "connect.php";

$polaczenie = new mysqli($server_name, $username, $password, $db_name);
$polaczenie->query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

if($polaczenie->connect_errno!=0){
    $error =  "Error: ". $polaczenie->connect_errno . " Szczegóły: " . $polaczenie->connect_error;
    header("Location: index.php?signup='$error'");
    exit();
} else{
    $email = $_POST['email'];
    $haslo = $_POST['password'];

    // $check_p = "SELECT haslo FROM logo WHERE email='$email'";

    // if($row=mysqli_fetch_assoc($polaczenie->query($check_p))){
    //     if(password_verify($haslo, $row['haslo'])){
    //        $proper_password = $row['haslo'];
    //     }else{
    //         header("Location: index.php?error=wronginputathere");
    //         exit();
    //     }
        
    // }

    $sql = "SELECT email, haslo, imie, nazwisko FROM czytelnik WHERE email=? and haslo=?";

    $stmt = mysqli_stmt_init($polaczenie);


    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: login_form.html?error=sqlerror&email=$email&haslo=$haslo;");
        exit();
    } else{

        mysqli_stmt_bind_param($stmt, 'ss', $email, $haslo);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){
        
        session_start();
        
        $_SESSION['imie'] = $row['imie'];
        $_SESSION['nazwisko'] = $row['nazwisko'];
        $_SESSION['email'] = $email;

        header('Location: udane_logowanie.php');
        exit();
        }
        else {
            header("Location: index.php?error=wronginput");
        }
    }
         $polaczenie->close();
}



?>