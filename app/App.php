<?php

namespace app;

use PDO;

class App {

  public $db;

  function __construct() {
    $admin = include 'app/config/admin.php';
    $this->db = new PDO("mysql:dbname=" . $admin['dbname'] . ";host=" . $admin['host'], $admin['user'], $admin['password']);
  }

  public function get_data($url) {
    $params = explode('/', str_replace('/api/', '', $url));
    if ($params[1]) {
      $sth = $this->db->prepare("SELECT * FROM ? WHERE id = ?");
      $sth->execute($params);
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      var_dump($result);
    } else {
      //
    }
  }

  public function get_view($url) {
    //
  }

}