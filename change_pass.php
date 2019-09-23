<?php

session_start();

if(!isset($_POST['old']) || !isset($_SESSION['email']) ){
    header("Location: settings.php");
    exit();
}

require_once "database.php";

try {
    $old = filter_input(INPUT_POST, 'old');
    $new1 = filter_input(INPUT_POST, 'new1');
    $new2 = filter_input(INPUT_POST, 'new2');

    $check_query = $db->query("SELECT * FROM uzytkownik WHERE email='{$_SESSION['email']}'");
    $c_result = $check_query->fetch();
    
    if(password_verify($old, $c_result['haslo'])){
        if($new1==$new2){

            $n_pass = password_hash($new1, PASSWORD_DEFAULT);

            $query = $db->prepare("UPDATE uzytkownik SET haslo=:haslo WHERE email='{$_SESSION['email']}'");
            $query->bindValue(':haslo', $n_pass, PDO::PARAM_STR);
            $query->execute();

            $_SESSION['change-success'] = "Zmiana hasła zakończona sukcesem";
            header("Location: settings.php?ok");
            
        }else {
            $_SESSION["no-identical"] = "Podane hasła różnią się";
            header("Location: settings.php");
            exit();
        }
    }else {
        $_SESSION["no-existing"] = "Podane hasło jest nieprawidłowe";
        header("Location: settings.php");
        exit();
    }

} catch (PDOException $e) {
    $_SESSION["public-err"] = $_SESSION['email'];
    $_SESSION["dev-err"] = $e;
    header("Location: settings.php");
}

