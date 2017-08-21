<?php

namespace Tuxi\Portfolio\Repository;

use Tuxi\Portfolio\Entity\Link;

/**
 * Object alloweing access to the data of link entity.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class LinkRepository extends Repository {
  
  public function findById(int $id): Link {
    $sql = "
      SELECT id, href, label, title, created
      FROM links
      WHERE id = :id
    ";
    $row = $this->getDb()->executeQuery($sql, ['id' => $id])->fetch();
    
    if(!$row) {
      throw new \Exception("No link matching id {$id}");
    }
    
    return $this->buildDomainObject($row);
  }

  /**
   * Creates a Link object based on a database row.
   * 
   * @param array $row The database row containing Link data.
   * @return Tuxi\Portfolio\Entity\Link The Link object based on
   * the database row.
   */
  protected function buildDomainObject(array $row) {
    $link = new Link();
    $link->setId($row['id']);
    $link->setHref($row['href']);
    $link->setLabel($row['label']);
    $link->setTitle($row['title']);
    $link->setCreated(new \DateTime($row['created']));
    
    return $link;
  }

}
