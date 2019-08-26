<?php

require_once "connect.php";

$connection = new mysqli($server_name, $username, $password, $db_name);
$sql1 = "SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor FROM egzemplarz, szczegoly WHERE czy_wyp!='1' AND szczegoly.ISBN=egzemplarz.ISBN";
$count = "SELECT COUNT(*) as total FROM egzemplarz WHERE czy_wyp='0'";


$result = $connection->query($sql1);

$dostepne = $connection->query($count);


while($row = $dostepne->fetch_assoc())
{
    $counter =  "<span class='counter'>Dostępnych egzemplarzy: <span style='color: red;'>".$row['total']."</span></span>";
}

if ($result->num_rows > 0) {

    $tabela_html = "<table class='tabelka'><tr><th>ID egzemplarza</th><th>Tytuł</th><th>Autor</th></tr>";

    while($row = $result->fetch_assoc()) {
        $tabela_html.= "<tr><td>".$row["id_egzemplarza"]."</td><td>".$row["nazwa"]."</td><td>".$row["autor"]."</td></tr>";
    }
    $tabela_html.= "<tr><th colspan='3'>$counter</th></tr></table>";
} else {
    $tabela_html = $counter;
}





$connection->close();

?>