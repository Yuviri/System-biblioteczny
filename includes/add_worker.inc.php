<?php

    session_start();

    require_once 'functions.inc.php';
    require_once 'autoloader.inc.php';

    if (!isset($_POST['imie'])) {
        header('Location: ../admin_panel.php');
    } else {
        
        $panel = new AdminPanel();

        // Pobranie danych z posta i walidacja

        $flag = false;

        $imie = clean_input($_POST['imie']);
        $nazwisko = clean_input($_POST['nazwisko']);
       
        if(!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
            $_SESSION['email_a_err'] = 'Niedozwolony email';
            $flag = true;
        }

        if (!$panel->checkWorker($email)) {
            $_SESSION['email_a_err'] = 'Podany email jest już zajęty';
            $flag = true;
        }

        if(strlen($_POST['haslo1'])<8){
            $_SESSION['haslo2_a_err']= 'Hasło musi się składać z conajmniej 8 znaków';
            $flag = true;
        } elseif ($_POST['haslo1']!==$_POST['haslo2']) {
            $_SESSION['haslo2_a_err']= 'Podane hasła muszą być identyczne';
            $flag = true;
        }
        $haslo = clean_input($_POST['haslo1']);
        $haslo = password_hash($haslo, PASSWORD_DEFAULT);


        $plec = clean_input($_POST['plec']);

        if(strlen($_POST['telefon']) < 9 || strlen($_POST['telefon']) > 20){
            $_SESSION['telefon_a_err'] = 'Telefon musi się składać z od 9 do 20 cyfr';
            $flag = true;
        }
        $telefon = clean_input($_POST['telefon']);

        // Sprawdzanie wartości flagi

        if($flag){
            header('Location: ../admin_panel.php');
        } else {
            
            $panel->add_worker($email, $haslo, $imie, $nazwisko, $plec, $telefon);
        }



    }



    // header("Location: ../admin_panel.php?good");