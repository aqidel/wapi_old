<?php

namespace app;

use PDO;

class Model {

  public $db;

  function __construct() {
    $admin = include 'app/config/admin.php';
    $this->db = new PDO("mysql:dbname=" . $admin['dbname'] . ";host=" . $admin['host'], $admin['user'], $admin['password']);
  }

}