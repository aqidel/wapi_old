<?php

namespace app;

class Controller {

  public $model;
  public $data;

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

  public function logger($data) {
    foreach($data as $value) {
      echo '<pre>' . var_dump($value) . '</pre>';
    }
  }

  public function get_data($url, $query) {
    $model_method = 'get_' . $url['path'];
    $this->data = $this->model->$model_method($query);
    $this->clear_data();
  }

  public function clear_data() {
    foreach($this->data as $key => $value) {
      if($value['id'] == $this->data[$key + 1]['id']) {
        $same_id_arr = $this->get_all_with_same_id($value['id']);
        $merged_arr = $this->merge_all_with_same_id($same_id_arr);
        array_push($this->data, $merged_arr);
      }
    }
    sort($this->data);
  }

  public function get_all_with_same_id($id) {
    $same_id_arr = [];
    foreach($this->data as $key => $value) {
      if($value['id'] == $id) {
        array_push($same_id_arr, $value);
        unset($this->data[$key]);
      }
    }
    return $same_id_arr;
  }

  public function merge_all_with_same_id($same_id_arr) {
    $merged_arr = array_merge_recursive(...$same_id_arr);
    foreach($merged_arr as $key => $value) {
      $uniq_val = array_unique($value);
      if(count($uniq_val) == 1) {
        $merged_arr[$key] = $uniq_val[0];
      }
    }
    return $merged_arr;
  }

  public function error_404() {
    echo '404 Error';
  }
   
}