<?php

namespace app;

class View {

  public function to_homepage() {

    include 'app/views/home.php';

  }

  public function error($error_code, $error_text) {

    if ($error_code == 404) {

      header('HTTP/1.1 404 Not Found');

    }

    if ($error_code == 500) {

      header('HTTP/1.1 500 Internal Server Error');

    }

    include 'app/views/error.php';
    
  }

}