<?php

    session_start();
    unset($_SESSION['imie']);
    unset($_SESSION['nazwisko']);

    session_destroy();

    header("Location: login_form.php");

?>