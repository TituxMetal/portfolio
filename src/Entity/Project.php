<?php

namespace Tuxi\Portfolio\Entity;

/**
 * Representation of a Project.
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Project {
  
  /**
   * Project id.
   *
   * @var integer
   */
  private $id;
  
  /**
   * Project title.
   *
   * @var string
   */
  private $title;
  
  /**
   * Project description.
   *
   * @var string
   */
  private $description;
  
  /**
   * Project created datetime.
   *
   * @var \DateTime
   */
  private $created;
  
  /**
   * Get id of the project.
   * 
   * @return int Returns the id of the project.
   */
  public function id(): int {
    
    return $this->id;
  }
  
  /**
   * Set the id of the project.
   * 
   * @param int $id The id to set to the project.
   */
  public function setId(int $id) {
    $this->id = (int) $id;
    
    return $this;
  }
  
  /**
   * Get title of the project.
   * 
   * @return string Returns the title of the project.
   */
  public function title(): string {
    
    return $this->title;
  }
  
  /**
   * Set the title of the project.
   * 
   * @param string $title The title to set to the project.
   */
  public function setTitle(string $title) {
    $this->title = $title;
    
    return $this;
  }
  
  /**
   * Get description of the project.
   * 
   * @return string Returns the description of the project.
   */
  public function description(): string {
    
    return $this->description;
  }
  
  /**
   * Set the description of the project.
   * 
   * @param string $description The description to set to the project.
   */
  public function setDescription(string $description) {
    $this->description = $description;
    
    return $this;
  }
  
  /**
   * Get the created datetime of the project.
   * 
   * @return \DateTime Returns the created datetime of the project.
   */
  public function created(): \DateTime {
    
    return $this->created;
  }
  
  /**
   * Set the created datetime of the project.
   * 
   * @param \DateTime $datetime The created datetime to set to the project.
   */
  public function setCreated(\DateTime $datetime) {
    $this->created = $datetime;
    
    return $this;
  }
  
}
