<?php

namespace Tuxi\Portfolio\Entity;

/**
 * Representation of a Technology.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Technology {
  
  /**
   * Technology id.
   *
   * @var integer
   */
  private $id;
  
  /**
   * Technology title.
   *
   * @var string
   */
  private $title;
  
  /**
   * Associated Image to the Technology.
   *
   * @var Titux\Portfolio\Entity\Image
   */
  private $image;
  
  /**
   * Technology created datetime.
   *
   * @var \DateTime
   */
  private $created;

  /**
   * Get id of the technology.
   * 
   * @return int Returns the id of the technology.
   */
  public function id(): int {
    
    return $this->id;
  }
  
  /**
   * Set the id of the technology.
   * 
   * @param int $id The id to set to the technology.
   */
  public function setId(int $id) {
    $this->id = (int) $id;
    
    return $this;
  }
  
  /**
   * Get title of the technology.
   * 
   * @return string Returns the title of the technology.
   */
  public function title(): string {
    
    return $this->title;
  }
  
  /**
   * Set the title of the technology.
   * 
   * @param string $title The title to set to the technology.
   */
  public function setTitle(string $title) {
    $this->title = $title;
    
    return $this;
  }
  
  /**
   * Get the Image object associated to the Technology.
   * 
   * @return \Tuxi\Portfolio\Entity\Image Returns the Image object associated to
   * the Technology.
   */
  public function image(): Image {
    
    return $this->image;
  }
  
  /**
   * Set the Image object to associate with the Technology.
   * 
   * @param \Tuxi\Portfolio\Entity\Image $image The Image object to associate
   * with the Technology.
   */
  public function setImage(Image $image) {
    $this->image = $image;
    
    return $this;
  }
  
  /**
   * Get the created datetime of the technology.
   * 
   * @return \DateTime Returns the created datetime of the technology.
   */
  public function created(): \DateTime {
    
    return $this->created;
  }
  
  /**
   * Set the created datetime of the technology.
   * 
   * @param \DateTime $datetime The created datetime to set to the technology.
   */
  public function setCreated(\DateTime $datetime) {
    $this->created = $datetime;
    
    return $this;
  }
  
}
