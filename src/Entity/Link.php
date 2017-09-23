<?php

namespace Tuxi\Portfolio\Entity;

/**
 * Representation of a Link.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Link {
  
  /**
   * Link id.
   *
   * @var integer
   */
  private $id;
  
  /**
   * Link href.
   *
   * @var string
   */
  private $href;
  
  /**
   * Link label.
   *
   * @var string
   */
  private $label;
  
  /**
   * Link title.
   *
   * @var string
   */
  private $title;
  
  /**
   * Link created datetime.
   *
   * @var \DateTime
   */
  private $created;
  
  /**
   * Get the id of the link.
   * 
   * @return int Returns the id of the link.
   */
  public function id(): int {
    
    return $this->id;
  }
  
  /**
   * Set the id of the link.
   * 
   * @param int $id The id to set to the link.
   */
  public function setId(int $id) {
    $this->id = $id;
    
    return $this;
  }
  
  /**
   * Get the href attribute of the link.
   * 
   * @return string Returns the href attribute of the link.
   */
  public function href(): string {
    
    return $this->href;
  }
  
  /**
   * Set the href attribute of the link.
   * 
   * @param string $href The href attribute to set to the link.
   */
  public function setHref(string $href) {
    $this->href = $href;
    
    return $this;
  }
  
  /**
   * Get the label of the link.
   * 
   * @return string Returns the label of the link.
   */
  public function label(): string {
    
    return $this->label;
  }
  
  /**
   * Set the label of the link.
   * 
   * @param string $label The label to set to the link.
   */
  public function setLabel(string $label) {
    $this->label = $label;
    
    return $this;
  }
  
  /**
   * Get the title attribute of the link.
   * 
   * @return string Returns the title attribute of the link.
   */
  public function title(): string {
    
    return $this->title;
  }
  
  /**
   * Set the title attribute of the link.
   * 
   * @param string $title The title attribute to set to the link.
   */
  public function setTitle(string $title) {
    $this->title = $title;
    
    return $this;
  }
  
  /**
   * Get the created datetime of the link.
   * 
   * @return \DateTime Returns the created datetime of the link.
   */
  public function created(): \DateTime {
    
    return $this->created;
  }
  
  /**
   * Set the created datetime of the link.
   * 
   * @param \DateTime $datetime The created datetime to set to the link.
   */
  public function setCreated(\DateTime $datetime) {
    $this->created = $datetime;
    
    return $this;
  }
  
}
