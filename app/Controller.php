<?php

namespace app;

class Controller {

  public $model;

  function __construct() {
    $this->model = new Model();
  }

  public function url_parser($url) {
    $url = str_replace('/api/', '', $url);
    $url = parse_url($url);
    if($url['query']) {
      $query = explode('=', $url['query']);
    }
    $this->get_data($url, $query);
  }

  public function get_data($url, $query) {
    $model_method = 'get_' . $url['path'];
    $data = $this->model->$model_method($query);
    var_dump($data);
  }

  public function error_404() {
    echo '404 Error';
  }
   
}