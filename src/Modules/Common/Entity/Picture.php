<?php

namespace Portfolio\Modules\Common\Entity;

/**
 * Description of Picture
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Picture {
  
  /**
   * @var int|null
   */
  private $id;
  
  /**
   * @var string|null
   */
  private $uri;
  
  /**
   * @var string|null
   */
  private $title;
  
  /**
   * Get the id of the picture
   *
   * @return int|null
   */
  public function getId() {
    
    return $this->id;
  }
  
  /**
   * Get the uri of the picture
   *
   * @return string|null
   */
  public function getUri() {
    
    return $this->uri;
  }
  
  /**
   * Get the title of the picture
   *
   * @return string|null
   */
  public function getTitle() {
    
    return $this->title;
  }
  
  /**
   * Set the id for the picture
   *
   * @param int $id
   */
  public function setId(int $id): void {
    $this->id = $id;
  }
  
  /**
   * Set the uri for the picture
   *
   * @param string $uri
   */
  public function setUri(string $uri): void {
    $this->uri = $uri;
  }
  
  /**
   * Set the title for the picture
   *
   * @param string $title
   */
  public function setTitle(string $title): void {
    $this->title = $title;
  }
}
