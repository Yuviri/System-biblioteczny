<?php

require_once "database.php";

$query = $db->query("SELECT min(egzemplarz.id_egzemplarza) as id, szczegoly.nazwa, szczegoly.autor FROM egzemplarz, szczegoly WHERE egzemplarz.ISBN = szczegoly.ISBN AND egzemplarz.czy_wyp=0 GROUP BY szczegoly.isbn");

$result = $query->fetchAll();

$output = "";

foreach ($result as $key => $value) {
  $output.= '<option class="person-item" value="'.$value['id'].'">'.$value['nazwa'].'</option>';
}

echo $output;
