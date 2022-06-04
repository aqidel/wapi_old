<?php

namespace app;

class Router {

  public $routes;

  function __construct($url) {
    $this->routes = require './app/config/routes.php';
    $this->url_match($url);
  }

  public function url_match($url) {
    foreach($this->routes as $route) {
      if(preg_match($route, $url)) {
        echo 'Success!';
        return;
      }
    }
    echo 'No such URL found!';
  }

}