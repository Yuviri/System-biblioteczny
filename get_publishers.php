<?php

require_once "database.php";

$query = $db->query("SELECT id_wydawnictwa, nazwa_wydawnictwa FROM wydawnictwo");

$result = $query->fetchAll();

$output = "";

foreach ($result as $key => $value) {
  $output.= '<option value="'.$value['id_wydawnictwa'].'">'.$value['nazwa_wydawnictwa'].'</option>';
}

echo $output;
