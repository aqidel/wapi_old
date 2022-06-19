<?php

namespace app;

class Controller {

  public $view;
  public $model;
  public $data;

  function __construct() {

    $this->view = new View();

    $this->model = new Model();

  }

  public function url_parser($url) {

    if ($url == '/') {

      $this->view->to_homepage();

    } else {

      $url = str_replace('/api/', '', $url);

      $url = parse_url($url);

      if (isset($url['query'])) {

        $query = explode('=', $url['query']);

        $json = $this->get_json($url, $query);

      } else {

        $json = $this->get_json($url);

      }

      $this->send_response($json);

    }

  }

  // Gets raw data from model based on URL and processes it to JSON format

  public function get_json($url, $query = []) {

    $model_method = 'get_' . $url['path'];

    $this->data = $this->model->$model_method($query);

    if (count($this->data) > 1) {

      $this->clear_data();

    }

    $json = json_encode($this->data);

    return $json;

  }

  // Cleaning of sub-arrays with same ID's

  public function clear_data() {

    foreach ($this->data as $key => $value) {

      // Detection of sub-arrays with same ID's

      if (isset($this->data[$key + 1]) && $value['id'] == $this->data[$key + 1]['id']) {

        // Temporary array with all elements with same ID for further joining

        $same_id_arr = $this->get_all_with_same_id($value['id']);

        // Merged array, e.g. ['profession'] => ['Barber', 'Surgeon']

        $merged_arr = $this->merge_all_with_same_id($same_id_arr);

        // Just push it to main array...

        array_push($this->data, $merged_arr);

        // Continue with updated data

        $this->clear_data();

      }

    }

    // ...and sort by ID's for beauty

    sort($this->data);

  }

  public function get_all_with_same_id($id) {

    $same_id_arr = [];

    foreach ($this->data as $key => $value) {

      if ($value['id'] == $id) {

        array_push($same_id_arr, $value);

        // Remove processed sub-array from main array

        unset($this->data[$key]);

      }

    }

    return $same_id_arr;

  }

  public function merge_all_with_same_id($same_id_arr) {

    $merged_arr = array_merge_recursive(...$same_id_arr);

    foreach ($merged_arr as $key => $value) {
      
      // Because array_merge_recursive() returns an array filled with sub-arrays, clear it where necessary

      $uniq_val = array_unique($value);

      if (count($uniq_val) == 1) {

        $merged_arr[$key] = $uniq_val[0];

      }

    }

    return $merged_arr;

  }

  public function send_response($json) {

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    echo $json;

  }
   
}