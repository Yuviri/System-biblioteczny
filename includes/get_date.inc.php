<?php

// Pobranie daty serwera
$today = new DateTime();
$estimated = new DateTime();
$today = $today->format("Y-m-d");
$estimated = $estimated->add(new DateInterval("P01M"));
$estimated = $estimated->format("Y-m-d");