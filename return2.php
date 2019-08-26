<?php

    header("Location: return.php");

    require_once "connect.php";
    require_once "index.php";

    $id_wyp = $_POST['id_wyp'];
    $egzemplarz = $_POST['egzemplarz'];
    $do = $_POST['do'];

    $connection = new mysqli($server_name, $username, $password, $db_name);
    $sql = "UPDATE wypozyczenie SET do = '$do' WHERE id_wyp='$id_wyp'";
    $sql2 = "UPDATE egzemplarz SET czy_wyp = '0' WHERE id_egzemplarza = '$egzemplarz';";
    $sql3 = "SELECT * FROM egzemplarz WHERE czy_wyp='1' AND id_egzemplarza='$egzemplarz'";
    $check=$connection->query($sql3);
    
    if($check->num_rows != 0)
    {
      if($result = $connection->query($sql) and $result2 = $connection->query($sql2))
      {
        echo "<br><span class='komunikat'>Wypożyczono egzemplarz</span><br><br><a href='return.php' class='hreturn'>Wróć do głównej strony</a>";
        echo "$check->num_rows";
        
      }
      else
      {
        echo "Wystąpił błąd";
      }
    }
    else
    {
      echo "Dany egzemplarz nie jest aktualnie wypożyczony";
    }

    


    
    $connection->close();
?>