<?php

namespace Portfolio\Modules\Technology\Entity;

use Portfolio\Core\Entity\Timestamp;
use Portfolio\Modules\Common\Entity\Picture;

/**
 * Description of Technology
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Technology {
  
  use Timestamp;
  
  /**
   * @var int|null
   */
  private $id;
  
  /**
   * @var string|null
   */
  private $name;
  
  /**
   * @var Picture|null
   */
  private $picture;
  
  /**
   * @var int|null
   */
  private $pictureId;
  
  /**
   * Get the id of the technology
   *
   * @return int|null
   */
  public function getId() {
    
    return $this->id;
  }
  
  /**
   * Get the name of the technology
   *
   * @return string|null
   */
  public function getName() {
    
    return $this->name;
  }
  
  /**
   * Get the picture entity
   *
   * @return Picture|null
   */
  public function getPicture() {
    
    return $this->picture;
  }
  
  /**
   * Get the pictureId of the technology
   *
   * @return int|null
   */
  public function getPictureId() {
    
    return $this->pictureId;
  }
  
  /**
   * Set the id for the technology
   *
   * @param int|null $id
   */
  public function setId($id): void {
    $this->id = $id;
  }
  
  /**
   * Set the name of the technology
   *
   * @param string|null $name
   */
  public function setName($name): void {
    $this->name = $name;
  }
  
  /**
   * Set the picture of the technology
   *
   * @param Picture|null $picture
   */
  public function setPicture($picture) {
    if (is_null($picture)) {
      $picture = new Picture();
    }
    $this->picture = $picture;
  }
  
  /**
   * Set the pictureId for the technology
   *
   * @param int|null $pictureId
   */
  public function setPictureId($pictureId): void {
    $this->pictureId = $pictureId;
  }
}
