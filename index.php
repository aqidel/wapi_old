<?php

spl_autoload_register(function ($class) {
  include './app/' . $class . '.php';
});

//include './app/Router.php';

$router = new Router($_SERVER['REQUEST_URI']);