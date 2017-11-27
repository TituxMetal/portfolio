<?php

namespace Tests;

use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseTestCase extends TestCase {

  /**
   *
   * @var PDO
   */
  protected $pdo;
  
  public function setUp() {
    $this->pdo = new PDO('sqlite::memory:', null, null, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
    
    $this->pdo->exec(
      "CREATE TABLE test (
        id integer PRIMARY KEY AUTOINCREMENT,
        title varchar(255),
        slug varchar(255)
      )"
    );
  }
  
  public function makeKnowledgeTable() {
    $this->pdo->exec(
      "CREATE TABLE Knowledge (
        id integer PRIMARY KEY AUTOINCREMENT,
        name varchar(255),
        created datetime,
        updated datetime
      )"
    );
  }
  
  public function makeTechnologyTable() {
    $this->pdo->exec(
      "CREATE TABLE Picture (
        id integer PRIMARY KEY AUTOINCREMENT,
        title varchar(255),
        uri varchar(255),
        created datetime,
        updated datetime
      )"
    );
    $this->pdo->exec(
      "CREATE TABLE Technology (
        id integer PRIMARY KEY AUTOINCREMENT,
        name varchar(255),
        picture integer(11),
        created datetime,
        updated datetime,
        CONSTRAINT picture
          FOREIGN KEY (picture)
          REFERENCES Picture(id)
      )"
    );
  }
  
  public function makeData(int $nb = 100) {
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO test (title, slug)
        VALUES ('aze$i', 'aze$i')"
      );
    }
  }
  
  public function makeKnowledgeData(int $nb = 100) {
    $datetime = date('Y-m-d H:i:s');
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO Knowledge (name, created, updated)
        VALUES ('aze$i', '$datetime', '$datetime')"
      );
    }
  }
  
  public function makeTechnologyData(int $nb = 100) {
    $datetime = date('Y-m-d H:i:s');
    
    $this->makePictureData();
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO Technology (name, picture, created, updated)
        VALUES ('aze$i', $i, '$datetime', '$datetime')"
      );
    }
  }
  
  public function makePictureData(int $nb = 100) {
    $datetime = date('Y-m-d H:i:s');
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO Picture (title, uri, created, updated)
        VALUES ('Title $i', '/assets/pictures/aze$i', '$datetime', '$datetime')"
      );
    }
  }
}
