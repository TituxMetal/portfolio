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
  
  public function makeData(int $nb = 100) {
    
    for ($i = 1; $i <= $nb; ++$i) {
      $this->pdo->exec(
        "INSERT INTO test (title, slug)
        VALUES ('aze$i', 'aze$i')"
      );
    }
  }
}
