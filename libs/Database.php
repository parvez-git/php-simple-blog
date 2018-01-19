<?php

class Database{

  private $dbhost = 'localhost';
  private $dbuser = 'root';
  private $dbpass = '';
  private $dbname = 'php_jw_ltp';
  public $conn;

  public function __construct()
  {
    if (!isset($this->conn)) {

      try {
        $link = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn = $link;

      } catch (PDOException $e) {
        die("Failed to connect with database". $e->getMessage());
      }

    }
  }
}
