<?php

class Router {

  public $routes;
  public $api;

  function __construct($url) {
    $this->routes = require 'app/routes.php';
    $this->api = new API();
    $this->url_match($url);
  }

  public function url_match($url) {
    foreach($this->routes as $route) {
      if(preg_match($route, $url)) {
        $this->api->checkout();
        return;
      }
    }
    echo 'URL is not found!';
  }

}