<?php

class MysqlHelper {
  private ?PDO $database;

  public function connect() {
    try {
      $this->database = new PDO('mysql:host=localhost:3306;dbname=market', 'root', 'root');
    } catch (PDOException $e) {
      throw $e;
    }
  }

  public function disconnect() {
    $this->database = null;
  }

  public function insert($sql, $params = []) {
    $this->connect();
    $stmt= $this->getDataBase()->prepare($sql);
    $stmt->execute($params);
    $lastId = $this->getDataBase()->lastInsertId();
    $this->disconnect();
    return $lastId;
  }

  public function remove($sql, $params = []) {
    $this->connect();
    $stmt= $this->getDataBase()->prepare($sql);
    $stmt->execute($params);
    $this->disconnect();
  }

  public function exists($sql, $params = []) {
    $this->connect();
    $stmt = $this->getDataBase()->prepare($sql);
    $stmt->execute($params);
    $exists = $stmt->fetchColumn() > 0; 
    $this->disconnect();
    return $exists;
  }

  public function getDataBase() {
    return $this->database;
  }
}