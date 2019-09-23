<?php

require_once "database.php";

$query = $db->query("SELECT egzemplarz.id_egzemplarza, szczegoly.nazwa, szczegoly.autor FROM egzemplarz, szczegoly WHERE egzemplarz.ISBN = szczegoly.ISBN AND egzemplarz.czy_wyp=1");

$result = $query->fetchAll();

$output = "";

foreach ($result as $key => $value) {
  $output.= '<option class="person-item" value="'.$value['id_egzemplarza'].'">'.$value['nazwa'].'</option>';
}

echo $output;

function checkSessionVar($var){
  if(isset($_SESSION[$var])){
    echo $_SESSION[$var];
    unset($_SESSION[$var]);
  }
}