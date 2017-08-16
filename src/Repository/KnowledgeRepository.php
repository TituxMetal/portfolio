<?php

namespace Tuxi\Portfolio\Repository;

use DateTime;
use Doctrine\DBAL\Connection;
use Tuxi\Portfolio\Entity\Knowledge;

class KnowledgeRepository {
  
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
  
  public function findAll() {
    $sql = 'SELECT id, title, created FROM knowledges ORDER BY id DESC';
    $result = $this->db->fetchAll($sql);
    
    $knowledges = [];
    foreach($result as $row) {
      $knowledgeId = $row['id'];
      $knowledges[$knowledgeId] = $this->buildKnowledge($row);
    }
    
    return $knowledges;
  }
  
  private function buildKnowledge($row) {
    $knowledge = new Knowledge();
    $knowledge->setId($row['id']);
    $knowledge->setTitle($row['title']);
    $knowledge->setCreated(new DateTime($row['created']));
    
    return $knowledge;
  }
  
}
