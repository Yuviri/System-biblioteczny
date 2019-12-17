<?php


if (!isset($_POST['title'])) {
    header('Location: add_books_form.php');
} else {

    session_start();

    require_once 'autoloader.inc.php';
    require_once 'functions.inc.php';

    //Dodaj sprawdzanie długości

    $isbn = $_POST['isbn'];
    $isbn = clean_input($isbn);

    $title = $_POST['title'];
    $title = clean_input($title);

    $author = $_POST['author'];
    $author = clean_input($author);

    $o_title = $_POST['o_title'];
    $o_title = clean_input($o_title);

    $genre = $_POST['genre'];
    $genre = clean_input($genre);

    $description = $_POST['description'];
    $description = clean_input($description);

    $publisher = $_POST['publisher'];
    $publisher = clean_input($publisher);
 
    $cover = $_FILES['cover'];

    //To ma związek ściśle z uploudem plików


    //Czy zmienna isbn jest intem oraz czy ma odpowiednią długość(niżej)  ZAMIENIĆ W JEDNEGO IFA PO WYKONANIU UPLOADU COVERA

    if(!preg_match("/^[1-9][0-9]*$/", $isbn)) {
        $_SESSION['a_isbn_err'] = '<div class="invalid-feedback">Nieprawidłowy numer ISBN</div>';
        
        $_SESSION['fill_title'] = $title;
        $_SESSION['fill_author'] = $author;
        $_SESSION['fill_o_title'] = $title;
        $_SESSION['fill_genre'] = $title;
        $_SESSION['fill_publisher'] = $publisher;
        $_SESSION['fill_description'] = $description;

        header('Location: ../add_books_form.php');
        exit();
    }

    if(strlen($isbn) <> 13) {
        $_SESSION['a_isbn_err'] = '<div class="invalid-feedback">Numer ISBN musi się składać z 13 cyfr</div>';
        
        $_SESSION['fill_title'] = $title;
        $_SESSION['fill_author'] = $author;
        $_SESSION['fill_o_title'] = $title;
        $_SESSION['fill_genre'] = $title;
        $_SESSION['fill_publisher'] = $publisher;
        $_SESSION['fill_description'] = $description;

        header('Location: ../add_books_form.php');
        exit();
    }

    $book = new AddBook($isbn, $title, $author, $o_title, $genre, $description, $publisher);

    // Warunek czy obrazek się zuploadował

    if(!$book->upload_cover($cover, $title, $author)){
        $_SESSION['a_cover_err'] = '<div class="invalid-feedback">'.$book->get_upload_err().'</div>';
        
        
        $_SESSION['fill_isbn'] = $isbn;
        $_SESSION['fill_title'] = $title;
        $_SESSION['fill_author'] = $author;
        $_SESSION['fill_o_title'] = $title;
        $_SESSION['fill_genre'] = $title;
        $_SESSION['fill_publisher'] = $publisher;
        $_SESSION['fill_description'] = $description;
    } 

    //Dodanie pozycji do bazy danych

    

    if($book->addB()){
        $_SESSION['a-success'] = '<div class="alert alert-success">Dodano nową pozycję</div>';
        header('Location: ../add_books_form.php?t');
    } else {
        $_SESSION['a-error'] = '<div class="alert alert-danger">Wystąpił problem</div>';
        header('Location: ../add_books_form.php');
    }

}