<?php

namespace Tuxi\Portfolio\Entity;

/**
 * Representation of an Image.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Image {
  
  /**
   * Image id.
   *
   * @var integer
   */
  private $id;
  
  /**
   * Image alt attribute.
   *
   * @var string
   */
  private $alt;
  
  /**
   * Image src attribute.
   *
   * @var string
   */
  private $src;
  
  /**
   * Image created datetime.
   *
   * @var \DateTime
   */
  private $created;
  
  /**
   * Get the id of the image.
   * 
   * @return int Returns the id of the image.
   */
  public function id(): int {
    
    return $this->id;
  }
  
  /**
   * Set the id of the image.
   * 
   * @param int $id The id to set to the image.
   */
  public function setId(int $id) {
    $this->id = (int) $id;
    
    return $this;
  }
  
  /**
   * Get the alt attribute of the image.
   * 
   * @return string Returns the alt attribute of the image.
   */
  public function alt(): string {
    
    return $this->alt;
  }
  
  /**
   * Set the alt attribute of the image.
   * 
   * @param string $alt The alt attribute to set to the image.
   */
  public function setAlt(string $alt) {
    $this->alt = $alt;
    
    return $this;
  }
  
  /**
   * Get the src attribute of the image.
   * 
   * @return string Returns the src attribute of the image.
   */
  public function src(): string {
    
    return $this->src;
  }
  
  /**
   * Set the src attribute of the image.
   * 
   * @param string $src The src attribute to set to the image.
   */
  public function setSrc(string $src) {
    $this->src = $src;
    
    return $this;
  }
  
  /**
   * Get the created datetime of the image.
   * 
   * @return string Returns the created datetime of the image.
   */
  public function created():\DateTime {
    
    return $this->created;
  }
  
  /**
   * Set the created datetime of the image.
   * 
   * @param \DateTime $datetime The created datetime to set to the image.
   */
  public function setCreated(\DateTime $datetime) {
    $this->created = $datetime;
    
    return $this;
  }
  
}
