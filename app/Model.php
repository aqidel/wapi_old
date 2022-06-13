<?php

namespace app;

use PDO;

class Model {

  public $db;

  function __construct() {

    $admin = include 'app/config/admin.php';

    $this->db = new PDO("mysql:dbname=" . $admin['dbname'] . ";host=" . $admin['host'], $admin['user'], $admin['password']);

  }

  public function db_call($sql) {

    $sth = $this->db->prepare($sql);

    $sth->execute();

    return $sth->fetchAll(PDO::FETCH_ASSOC);

  }

  public function get_characters($query) {

    if ($query[0] == 'id') {

      $sql = "SELECT characters.*, professions.profession FROM characters INNER JOIN char_prof ON characters.id = char_prof.char_id INNER JOIN professions ON professions.id = char_prof.prof_id WHERE characters.id = " . $query[1];

    }
  
    else if ($query[0] == 'limit') {

      $sql = "SELECT characters.*, professions.profession FROM characters INNER JOIN char_prof ON characters.id = char_prof.char_id INNER JOIN professions ON professions.id = char_prof.prof_id LIMIT " . $query[1];
    
    } 

    else {

      $sql = "SELECT characters.*, professions.profession FROM characters INNER JOIN char_prof ON characters.id = char_prof.char_id INNER JOIN professions ON professions.id = char_prof.prof_id";
    
    }

    return $this->db_call($sql);

  }

  public function get_professions($query) {

    if ($query[0] == 'id') {

      $sql = "SELECT * FROM professions WHERE id = " . $query[1];
    
    }

    else if ($query[0] == 'limit') {

      $sql = "SELECT * FROM professions LIMIT " . $query[1];
    
    }

    else {

      $sql = "SELECT * FROM professions";
    
    }

    return $this->db_call($sql);

  }

  public function get_countries($query) {

    if ($query[0] == 'id') {

      $sql = "SELECT countries.*, cities.city FROM countries INNER JOIN country_city ON countries.id = country_city.country_id INNER JOIN cities ON cities.id = country_city.city_id WHERE countries.id = " . $query[1];
    
    }

    else if ($query[0] == 'limit') {

      $sql = "SELECT countries.*, cities.city FROM countries INNER JOIN country_city ON countries.id = country_city.country_id INNER JOIN cities ON cities.id = country_city.city_id LIMIT " . $query[1];
    
    }

    else {

      $sql = "SELECT countries.*, cities.city FROM countries INNER JOIN country_city ON countries.id = country_city.country_id INNER JOIN cities ON cities.id = country_city.city_id";
    
    }

    return $this->db_call($sql);

  }

  public function get_cities($query) {

    if ($query[0] == 'id') {

      $sql = "SELECT * FROM cities WHERE id = " . $query[1];

    }

    else if($query[0] == 'limit') {

      $sql = "SELECT * FROM cities LIMIT " . $query[1];

    }

    else {

      $sql = "SELECT * FROM cities";

    }

    return $this->db_call($sql);
    
  }

}