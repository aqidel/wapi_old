<?php

class Parser {

  public $db;

  function __construct($filename, $dbname = 'wapidb', $host = '127.0.0.1', $user = 'edward', $password = '555777') {
    $this->db = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $password);
    $rows = $this->prepare_csv($filename);
    $this->dump_data($rows, $filename);
  }

  public function prepare_csv($filename) {
    $rows = file("./data/" . $filename . ".csv");
    // Remove row with headers
    array_splice($rows, 0, 1);
    // Convert row-strings to array-strings
    foreach($rows as $key => $row) {
      $no_spec_chars = preg_replace("!\r?\n!", "", $row);
      $rows[$key] = explode(',', $no_spec_chars);
    }
    return $rows;
  }

  public function dump_data($rows, $filename) {
    foreach($rows as $row) {
      $place_holders = implode(',', array_fill(0, count($row), '?'));
      $sth = $this->db->prepare("INSERT INTO $filename VALUES($place_holders);");
      $sth->execute($row);
    }
  }
  
}

$parser = new Parser('professions');