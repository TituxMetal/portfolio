<?php

namespace Tuxi\Portfolio\Entity;

/**
 * Representation of a Knowledge.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Knowledge {
  
  /**
   * Knowledge id.
   * 
   * @var integer
   */
  private $id;
  
  /**
   * Knowledge title.
   *
   * @var string
   */
  private $title;
  
  /**
   * Knowledge created datetime.
   *
   * @var \DateTime
   */
  private $created;
  
  /**
   * Get id of the knowledge.
   * 
   * @return int Returns the id of the knowledge.
   */
  public function id(): int {
    
    return $this->id;
  }
  
  /**
   * Set the id of the knowledge.
   * 
   * @param int $id The id to set to the knowledge.
   */
  public function setId(int $id) {
    $this->id = (int) $id;
    
    return $this;
  }
  
  /**
   * Get title of the knowledge.
   * 
   * @return string Returns the title of the knowledge.
   */
  public function title(): string {
    
    return $this->title;
  }
  
  /**
   * Set the title of the knowledge.
   * 
   * @param string $title The title to set to the knowledge.
   */
  public function setTitle(string $title) {
    $this->title = $title;
    
    return $this;
  }
  
  /**
   * Get the created datetime of the knowledge.
   * 
   * @return \DateTime Returns the created datetime of the knowledge.
   */
  public function created(): \DateTime {
    
    return $this->created;
  }
  
  /**
   * Set the created datetime of the knowledge.
   * 
   * @param \DateTime $datetime The created datetime to set to the knowledge.
   */
  public function setCreated(\DateTime $datetime) {
    $this->created = $datetime;
    
    return $this;
  }
  
}
