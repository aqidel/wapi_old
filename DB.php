<?php

class DB {

  public $db;
  public $table_name;

  function __construct() {

    $admin = require './app/config/admin.php';

    $this->table_name = readline('Enter name of a table to dump: ');

    $this->db_connect($admin);

  }

  public function db_connect($admin) {

    $this->db = new PDO('mysql:dbname=' . $admin['dbname'] . ';host=' . $admin['host'], $admin['user'], $admin['password']);

    $rows = $this->prepare_csv();

    $this->dump_data($rows);
    
  }

  public function prepare_csv() {

    $rows = file('./data/' . $this->table_name . '.csv');

    // Remove row with headers

    array_splice($rows, 0, 1);

    // Convert row-strings to array-strings

    foreach ($rows as $key => $row) {

      $no_spec_chars = preg_replace("!\r?\n!", "", $row);

      $rows[$key] = explode(',', $no_spec_chars);

    }

    return $rows;

  }

  public function dump_data($rows) {

    foreach ($rows as $row) {

      $place_holders = implode(',', array_fill(0, count($row), '?'));

      $sth = $this->db->prepare("INSERT INTO $this->table_name VALUES($place_holders);");

      $sth->execute($row);

    }

  }
  
}

$db_dump = new DB();