<?php

class Database
{
  //DB params
  private $host = 'localhost';
  private $db_name = 'register';
  private $username = 'root';
  private $pass = '';
  private $conn;

  //DB connect
    public function connect()
    {

      try {
      $this->conn = new PDO('mysql:host='.$this->host.';dbname='.
      $this->db_name,
      $this->username,
      $this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        echo 'connection Error:'.$e->getMessage();
      }
      return $this->conn;

    }

}
