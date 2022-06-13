<?php

namespace app;

class Router {

  public $routes;
  public $controller;

  function __construct($url) {

    $this->routes = require './app/config/routes.php';

    $this->controller = new Controller();

    $this->url_match($url);

  }

  public function url_match($url) {

    foreach ($this->routes as $route) {

      if (preg_match($route, $url)) {

        $this->controller->url_parser($url);

        return;

      }

    }

    $this->controller->error_404();
    
  }

}