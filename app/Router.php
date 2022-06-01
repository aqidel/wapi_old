<?php

namespace app;

class Router {

  public $routes;
  public $app;

  function __construct($url) {
    $this->routes = require './app/config/routes.php';
    $this->app = new App();
    $this->url_match($url);
  }

  public function url_match($url) {
    foreach($this->routes as $route) {
      if(preg_match($route, $url)) {
        $this->app->checkout();
        return;
      }
    }
    echo 'URL is not found!';
  }

}