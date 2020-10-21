<?php

namespace App;

class DataBase {

  protected $db;

  public function __construct()
  {
    $this->db = $this->connect();
  }

  private function connect()
  {
    return new \mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
  }

  public function escape_string($var)
  {
    $var = $this->db->escape_string($var);
    return $var;
  }

  public function query($query)
  {
    $result = $this->db->query($query);
    return $result;
  }
}
