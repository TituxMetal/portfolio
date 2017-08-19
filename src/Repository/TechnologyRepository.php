<?php

namespace Tuxi\Portfolio\Repository;

use DateTime;
use Tuxi\Portfolio\Entity\Technology;

/**
 * Object allowing access to the data of technologies entity.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TechnologyRepository extends Repository {
  
  /**
   * Return a list of all technologies, sorted by id.
   * 
   * @return array A list of all technologies.
   */
  public function findAll() {
    $sql = "
      SELECT id, title, created
      FROM technologies
      ORDER BY id ASC
    ";
    $result = $this->getDb()->fetchAll($sql);
    
    $technologies = [];
    foreach($result as $row) {
      $technologyId = $row['id'];
      $technologies[$technologyId] = $this->buildDomainObject($row);
    }
    
    return $technologies;
  }
  
  /**
   * Creates a Technology object based on a database row.
   * 
   * @param array $row The database row containing Technology data.
   * @return Tuxi\Portfolio\Entity\Technology The Technology object based on
   * the database row.
   */
  protected function buildDomainObject(array $row) {
    $technology = new Technology();
    $technology->setId($row['id']);
    $technology->setTitle($row['title']);
    $technology->setCreated(new DateTime($row['created']));
    
    return $technology;
  }

}
