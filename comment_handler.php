<?php

require_once "includes/autoloader.inc.php";

$obj = new Comments();

if (!isset($_POST['comment'])) {
        $output = $_POST['author'];
        echo $output;
        exit();
} else if($_POST['request']==='new') {
    
    // Obsługa nowych komentarzy


    // Przypisanie zmiennych z posta

    $email = $_POST['author'];
    $isbn = $_POST['book'];
    $text = $_POST['comment'];

    // Data wstawienia

    $date = date('Y-m-d H:i:s');

    

    if($obj->addComment($email, $isbn, $date, $text)){
        $output = '<span class = "text-success">Opublikowano komentarz. Pojawi się po odświeżeniu strony.</span>';
        echo $output;
    } else {
        $output = '<span class = "text-danger">Wystąpił błąd, spróbuj ponownie później.</span>';
        echo $output;
    }
    
} else {
    // Obsługa edycji

    $email = $_POST['author'];
    $isbn = $_POST['book'];
    $text = $_POST['comment'];

    if($obj->editComment($email, $isbn, $text)){
        $output = $text;
        echo $output;
    } else {
        $output = '<span class = "text-danger">Wystąpił błąd, spróbuj ponownie później.</span>';
        echo $output;
    }

}