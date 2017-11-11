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
  
  public function makeKnowledgesTable() {
    $this->pdo->exec(
      "CREATE TABLE Knowledges (
        id integer PRIMARY KEY AUTOINCREMENT,
        name varchar(255),
        created datetime,
        updated datetime
      )"
    );
  }
  
  public function makeTechnologiesTable() {
    $this->pdo->exec(
      "CREATE TABLE Pictures (
        id integer PRIMARY KEY AUTOINCREMENT,
        title varchar(255),
        uri varchar(255),
        created datetime,
        updated datetime
      )"
    );
    $this->pdo->exec(
      "CREATE TABLE Technologies (
        id integer PRIMARY KEY AUTOINCREMENT,
        name varchar(255),
        pictureId integer(11),
        created datetime,
        updated datetime,
        CONSTRAINT picture
          FOREIGN KEY (pictureId)
          REFERENCES Pictures(id)
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
  
  public function makeKnowledgesData(int $nb = 100) {
    $datetime = date('Y-m-d H:i:s');
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO Knowledges (name, created, updated)
        VALUES ('aze$i', '$datetime', '$datetime')"
      );
    }
  }
  
  public function makeTechnologiesData(int $nb = 100) {
    $datetime = date('Y-m-d H:i:s');
    
    $this->makePicturesData();
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO Technologies (name, pictureId, created, updated)
        VALUES ('aze$i', $i, '$datetime', '$datetime')"
      );
    }
  }
  
  public function makePicturesData(int $nb = 100) {
    $datetime = date('Y-m-d H:i:s');
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO Pictures (title, uri, created, updated)
        VALUES ('Title $i', '/assets/pictures/aze$i', '$datetime', '$datetime')"
      );
    }
  }
}
