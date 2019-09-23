<?php
    session_start();

    if(isset($_POST["data_zwrotu"]) && isset($_POST["egzemplarz"])){
      
      require_once 'database.php';

      try {
        // if(!filter_input(INPUT_POST, 'czytelnik', FILTER_VALIDATE_EMAIL)){
        //   $_SESSION['l_email_err'] = '<div class="invalid-feedback">Nieprawidłowy adres email</div>';
        //   header("Location: lend_form.php");
        //   exit();
        // }
        // else {
        //   $czytelnik = filter_input(INPUT_POST, 'czytelnik', FILTER_VALIDATE_EMAIL);
        // }
        if(!filter_input(INPUT_POST, 'egzemplarz', FILTER_VALIDATE_INT)){
          $_SESSION['r_egz_err'] = '<div class="invalid-feedback">Podany egzemplarz jest nieprawidłowy</div>';
          header("Location: return_form.php");
          exit();
        } else {
          $egzemplarz = filter_input(INPUT_POST, 'egzemplarz', FILTER_VALIDATE_INT);
        }

        $data_zwrotu = filter_input(INPUT_POST, 'data_zwrotu');

     

        // Sprawdzanie czy konkretny egzemplarz jest już wypożyczony

        $query = $db->prepare("SELECT * FROM egzemplarz WHERE id_egzemplarza=:egzemplarz and czy_wyp=0");
        $query->bindValue(":egzemplarz", $egzemplarz);
        $query->execute();


        if($query->rowCount()>0){
          $_SESSION['nonexisting-err'] = "<div class='alert alert-warning'>Dany egzemplarz nie jest wypożyczony</div>";
          header("Location: return_form.php?c");
        } else {
          $db->query("UPDATE wypozyczenie SET data_zwrotu='$data_zwrotu' WHERE id_egzemplarza='$egzemplarz'");
          $db->query("UPDATE egzemplarz SET czy_wyp=0 WHERE id_egzemplarza='$egzemplarz'");
          $_SESSION['success'] = "<div class='alert alert-success'>Zwrócono egzemplarz</div>";
          header("Location: return_form.php");
        }

      } catch (PDOException $e) {
        if ($e->getCode()==23000) {
          $_SESSION['r_egz_err'] = '<div class="invalid-feedback">Podany egzemplarz nie istnieje</div>';
          header("Location: return_form.php?e");
        } else{
        $_SESSION['public-err'] = "<div class='alert alert-danger'>Wystąpił problem po stronie servera</div>";
        $_SESSION['dev-err'] = "<div class='alert alert-primary'>".$e."</div>";
        header("Location: return_form.php");
        }
      }
    } else {
      header("Location: return_form.php");
    }

?>