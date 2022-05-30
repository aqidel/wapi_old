<?php

class Router {

  public $patterns;
  public $url;

  function __construct($url) {
    $this->url = $url;
    $this->patterns = include './patterns.php';
  }

  public function url_match() {
    foreach($this->patterns as $pattern) {
      if(preg_match($pattern, $this->url)) {
        return;
      }
    }
    echo 'URL is not found!';
  }

}