<?php

require_once "database.php";

$query = $db->query("SELECT rezerwacja.id_rez, rezerwacja.czytelnik, szczegoly.nazwa FROM rezerwacja, szczegoly, egzemplarz WHERE rezerwacja.egzemplarz=egzemplarz.id_egzemplarza AND egzemplarz.ISBN=szczegoly.ISBN AND status='aktywna'");

$result = $query->fetchAll();

$output = "";

foreach ($result as $key => $value) {
  $output.= '<option value="'.$value['id_rez'].'" data-subtext="'.$value['czytelnik'].'">'.$value['nazwa'].'</option>';
}

echo $output;
