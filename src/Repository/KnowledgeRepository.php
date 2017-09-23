<?php

namespace Tuxi\Portfolio\Repository;

use DateTime;
use Tuxi\Portfolio\Entity\Knowledge;

/**
 * Object allowing access to the data of knowledges entity.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class KnowledgeRepository extends Repository {
  
  /**
   * Return a list of all knowledges, sorted by id.
   * 
   * @return array A list of all knowledges.
   */
  public function findAll() {
    $sql = "
      SELECT id, title, created
      FROM knowledges
      ORDER BY id ASC
    ";
    $result = $this->getDb()->fetchAll($sql);
    
    $knowledges = [];
    foreach($result as $row) {
      $knowledgeId = $row['id'];
      $knowledges[$knowledgeId] = $this->buildDomainObject($row);
    }
    
    return $knowledges;
  }
  
  /**
   * Creates a Knowledge object based on a database row.
   * 
   * @param array $row The database row containing Knowledge data.
   * @return Tuxi\Portfolio\Entity\Knowledge The Knowledge object based on
   * the database row.
   */
  protected function buildDomainObject(array $row) {
    $knowledge = new Knowledge();
    $knowledge->setId($row['id']);
    $knowledge->setTitle($row['title']);
    $knowledge->setCreated(new DateTime($row['created']));
    
    return $knowledge;
  }

}
