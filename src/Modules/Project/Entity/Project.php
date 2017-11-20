<?php

namespace Portfolio\Modules\Project\Entity;

use Portfolio\Core\Entity\Timestamp;
use Portfolio\Modules\Common\Entity\Picture;

/**
 * Description of Project
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Project {
  
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
   * @var string|null
   */
  private $content;
  
  /**
   * @var Picture|null
   */
  private $picture;
  
  /**
   * @var Link|null
   */
  private $mainLink;
  
  /**
   * @var Link|null
   */
  private $sourceLink;
  
  /**
   * Get the id of the project
   * 
   * @return int|null
   */
  public function getId() {
    
    return $this->id;
  }
  
  /**
   * Get the name of the project
   * 
   * @return string|null
   */
  public function getName() {
    
    return $this->name;
  }
  
  /**
   * Get the content of the project
   * 
   * @return string|null
   */
  public function getContent() {
    
    return $this->content;
  }
  
  /**
   * Get the Picture entity
   * 
   * @return Picture|null
   */
  public function getPicture() {
    
    return $this->picture;
  }
  
  /**
   * Get the mainLink of the project
   * 
   * @return Link|null
   */
  public function getMainLink() {
    
    return $this->mainLink;
  }
  
  /**
   * Get the sourceLink of the project
   * 
   * @return Link|null
   */
  public function getSourceLink() {
    
    return $this->sourceLink;
  }
  
  /**
   * Set the id of the project
   * 
   * @param int|null $id
   */
  public function setId($id): void {
    $this->id = $id;
  }
  
  /**
   * Set the name of the project
   * 
   * @param string|null $name
   */
  public function setName($name): void {
    $this->name = $name;
  }
  
  /**
   * Set the content of the project
   * 
   * @param string|null $content
   */
  public function setContent($content): void {
    $this->content = $content;
  }
  
  /**
   * Set the picture of the project
   * 
   * @param Picture|null $picture
   */
  public function setPicture($picture): void {
    if (is_null($picture)) {
      $picture = new Picture();
    }
    
    $this->picture = $picture;
  }
  
  /**
   * Set the mainLink of the project
   * 
   * @param Link|null $mainLink
   */
  public function setMainLink($mainLink): void {
    $this->mainLink = $mainLink;
  }
  
  /**
   * Set the sourceLink of the project
   * 
   * @param Link|null $sourceLink
   */
  public function setSourceLink($sourceLink): void {
    $this->sourceLink = $sourceLink;
  }
  
}
