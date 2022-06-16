<?php

namespace app;

class Router {

  public $view;
  public $routes;
  public $controller;

  function __construct($url) {

    $this->view = new View();

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

    $this->view->error(404, 'No such URL exists!');
    
  }

}