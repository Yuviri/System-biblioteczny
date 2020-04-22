<?php


if (!isset($_POST['isbn'])) {
    header('Location: add_books_ex_form.php');
} else {

    session_start();

    require_once 'autoloader.inc.php';
    require_once 'functions.inc.php';


    $isbn = $_POST['isbn'];
    $isbn = clean_input($isbn);

    $quantity = $_POST['quantity'];
    $quantity = clean_input($quantity);


    if(!preg_match("/^[1-9][0-9]*$/", $isbn)) {
        $_SESSION['a_isbn_err'] = '<div class="invalid-feedback">Nieprawidłowy numer ISBN</div>';
        
        $_SESSION['fill_quantity'] = $quantity;

        header('Location: ../add_books_ex_form.php');
        exit();
    }

    if(!preg_match("/^[1-9][0-9]*$/", $quantity)) {
        $_SESSION['a_quantity_err'] = '<div class="invalid-feedback">Nieprawidłowa ilość</div>';
        
        $_SESSION['fill_isbn'] = $isbn;

        header('Location: ../add_books_ex_form.php');
        exit();
    }

    if(strlen($isbn) <> 13) {
        $_SESSION['a_isbn_err'] = '<div class="invalid-feedback">Numer ISBN musi się składać z 13 cyfr</div>';
        
        $_SESSION['fill_quantity'] = $quantity;

        header('Location: ../add_books_ex_form.php');
        exit();
    }

    //Dodanie pozycji do bazy danych

    $book = new AddExBook($isbn, $quantity);

    if($book->addExB()){
        $_SESSION['a-success'] = '<div class="alert alert-success">Dodano nowe egzemplarze</div>';
        header('Location: ../add_books_ex_form.php?t');
    } else {
        $_SESSION['a-error'] = '<div class="alert alert-danger">Wystąpił problem</div>';
        header('Location: ../add_books_ex_form.php');
    }

}