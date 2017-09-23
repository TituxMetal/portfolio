<?php

namespace Tuxi\Portfolio\Repository;

use Doctrine\DBAL\Connection;

/**
 * Common class that allows child classes to access the connection to
 * the database.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
abstract class Repository {
  
  /**
   * Database connection.
   *
   * @var Doctrine\DBAL\Connection
   */
  private $db;
  
  /**
   * Constructor.
   * 
   * @param Doctrine\DBAL\Connection $db The database connection object.
   */
  public function __construct(Connection $db) {
    $this->db = $db;
  }
  
  /**
   * Get the database connection object.
   * 
   * @return Doctrine\DBAL\Connection The database connection object.
   */
  public function getDb() {
    
    return $this->db;
  }
  
  /**
   * Builds a domain object from a database row.
   * Must be overriden by child classes.
   */
  protected abstract function buildDomainObject(array $row);
  
}
