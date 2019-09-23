<?php

require_once "database.php";

$query = $db->query("SELECT imie, nazwisko, email FROM uzytkownik");

$result = $query->fetchAll();

$output = "";

foreach ($result as $key => $value) {
  $output.= '<option class="person-item" value="'.$value['email'].'">'.$value['imie'].' '.$value['nazwisko'].'</option>';
}

echo $output;


function checkSessionVar($var){
  if(isset($_SESSION[$var])){
    echo $_SESSION[$var];
    unset($_SESSION[$var]);
  }
}