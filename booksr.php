<?php

require_once "connect.php";

$connection = new mysqli($server_name, $username, $password, $db_name);

$sql2 = "SELECT wypozyczenie.id_wyp, egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor, wypozyczenie.od FROM wypozyczenie, egzemplarz, szczegoly WHERE czy_wyp!='0' AND do IS NULL AND szczegoly.ISBN=egzemplarz.ISBN AND wypozyczenie.id_egzemplarza = egzemplarz.id_egzemplarza";

$count2 = "SELECT COUNT(*) as total FROM egzemplarz WHERE czy_wyp='1'";


$result2 = $connection->query($sql2);

$niedostepne = $connection->query($count2);
$tabela_html2 = "";


while($row = $niedostepne->fetch_assoc())
{
    $counter2 =  "<span class='counter'>Wypożyczonych egzemplarzy: <span style='color: red;'>".$row['total']."</span></span>";
}

if ($result2->num_rows > 0) {

    $tabela_html2 = "<table class='tabelka'><tr><th>ID wypożyczenia</th><th>ID egzemplarza</th><th>Tytuł</th><th>Autor</th><th>Data wypożyczenia</th></tr>";

    while($row = $result2->fetch_assoc()) {
        $tabela_html2.= "<tr><td>".$row["id_wyp"]."</td><td>".$row["id_egzemplarza"]."</td><td>".$row["nazwa"]."</td><td>".$row["autor"]."</td><td>".$row["od"]."</td></tr>";
    }
    $tabela_html2.= "<tr><th colspan='5'>$counter2</th></tr></table>";
} else {
    $tabela_html2 = $counter2;
}



$connection->close();

?>