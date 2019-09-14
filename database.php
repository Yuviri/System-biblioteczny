<?php

$connect = require_once 'connect.php';


try {
    $db = new PDO("mysql:host={$connect['host']}; dbname={$connect['name']}; charset=utf8", 
    $connect['user'], 
    $connect['password'], 
    [   
        PDO::ATTR_EMULATE_PREPARES=>false,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    exit("Database connection error");
}