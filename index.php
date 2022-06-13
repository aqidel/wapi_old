<?php

spl_autoload_register(function($class) {

  $class = str_replace('\\', '/', $class . '.php');

  include $class;
  
});

use app\Router;

$router = new Router($_SERVER['REQUEST_URI']);