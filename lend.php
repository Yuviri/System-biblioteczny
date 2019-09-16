<?php
    session_start();

    if(isset($_POST["czytelnik"]) && isset($_POST["egzemplarz"])){
      
      require_once 'database.php';

      try {
        $czytelnik = filter_input(INPUT_POST, 'czytelnik', FILTER_VALIDATE_EMAIL);
        $egzemplarz = filter_input(INPUT_POST, 'egzemplarz', FILTER_VALIDATE_INT);
        $od = filter_input(INPUT_POST, 'od');
        $do = filter_input(INPUT_POST, 'do');
        $pracownik = $_SESSION['email'];

        // Sprawdzanie czy konkretny egzemplarz nie jest już wypożyczony

        $query = $db->prepare("SELECT * FROM egzemplarz WHERE id_egzemplarza=:egzemplarz and czy_wyp=1");
        $query->bindValue(":egzemplarz", $egzemplarz);
        $query->execute();


        if($query->rowCount()>0){
          $_SESSION['existing-err'] = "<div class='alert alert-warning'>Dany egzemplarz jest już wypożyczony</div>";
          header("Location: lend_form.php");
        } else {
          $insert = $db->query("INSERT INTO wypozyczenie VALUES(NULL, '$czytelnik', '$pracownik', '$egzemplarz', '$od', '$do')");
          $_SESSION['success'] = "<div class='alert alert-success'>Wypozyczono egzemplarz</div>";
          header("Location: lend_form.php");
        }

      } catch (PDOException $e) {
        $_SESSION['public-err'] = "<div class='alert alert-danger'>Wystąpił problem po stronie servera</div>";
        $_SESSION['dev-err'] = "<div class='alert alert-primary'>".$e."</div>";
        header("Location: lend_form.php");
      }
    } else {
      header("Location: lend_form.php");
    }

?>