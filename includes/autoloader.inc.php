<?php

spl_autoload_register("classLoader");

function classLoader($className){

  $url = $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];

  if (strpos($url, 'includes')!== false || strpos($url, 'scripts')!== false) {
    $path = '../classes/';
  } else {
    $path = 'classes/';
  }

  $extension = '.class.php';

  require_once $path.$className.$extension;

}
