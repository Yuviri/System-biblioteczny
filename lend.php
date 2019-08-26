<?php



    header("Location: index.php");


    require_once "connect.php";
    require_once "index.php";

    $czytelnik = $_POST['czytelnik'];
    $egzemplarz = $_POST['egzemplarz'];
    $pracownik = $_POST['pracownik'];
    $od = $_POST['od'];

    $connection = new mysqli($server_name, $username, $password, $db_name);
    $sql = "INSERT INTO wypozyczenie(email, id_egzemplarza, id_pracownika, od) VALUES('$czytelnik','$egzemplarz','$pracownik','$od')";
    $sql2 = "UPDATE egzemplarz SET czy_wyp = '1' WHERE id_egzemplarza = '$egzemplarz';";
    $sql3 = "SELECT * FROM egzemplarz WHERE czy_wyp='0' AND id_egzemplarza='$egzemplarz'";
    $check=$connection->query($sql3);
    
    if($check->num_rows != 0)
    {
      if($result = $connection->query($sql) and $result2 = $connection->query($sql2))
      {
        echo "<br><span class='komunikat'>Wypożyczono egzemplarz</span><br><br><a href='index.php' class='hreturn'>Wróć do głównej strony</a>";
        echo "$check->num_rows";
        
      }
      else
      {
        echo "Wystąpił błąd";
      }
    }
    else
    {
      echo "Dany egzemplarz jest już wypożyczony";
    }

    


    
    $connection->close();
?>