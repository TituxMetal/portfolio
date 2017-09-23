<?php

namespace Tuxi\Portfolio\Repository;

use Tuxi\Portfolio\Entity\Image;

/**
 * Object allowing access to the data of images entity.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ImageRepository extends Repository {
  
  public function findById(int $id): Image {
    $sql = "
      SELECT id, alt, src, created
      FROM images
      WHERE id = :id
    ";
    $row = $this->getDb()->executeQuery($sql, ['id' => $id])->fetch();
    
    if(!$row) {
      
      throw new \Exception("No image matching id {$id}");
    }
    
    return $this->buildDomainObject($row);
  }
  
  /**
   * Creates a Image object based on a database row.
   * 
   * @param array $row The database row containing Image data.
   * @return Tuxi\Portfolio\Entity\Image The Image object based on
   * the database row.
   */
  protected function buildDomainObject(array $row) {
    $image = new Image();
    $image->setId($row['id']);
    $image->setAlt($row['alt']);
    $image->setSrc($row['src']);
    $image->setCreated(new \DateTime($row['created']));
    
    return $image;
  }

}
