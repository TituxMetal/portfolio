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
   * Project name.
   *
   * @var string
   */
  private $name;
  
  /**
   * Project description.
   *
   * @var string
   */
  private $description;
  
  /**
   * Associated Image to the Project.
   *
   * @var Titux\Portfolio\Entity\Image
   */
  private $image;
  
  /**
   * Associated main Link to the Project.
   *
   * @var Titux\Portfolio\Entity\Link
   */
  private $mainLink;
  
  /**
   * Associated sources Link to the Project.
   *
   * @var Titux\Portfolio\Entity\Link
   */
  private $sourcesLink;
  
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
   * Get the name of the project.
   * 
   * @return string Returns the name of the project.
   */
  public function name(): string {
    
    return $this->name;
  }
  
  /**
   * Set the name of the project.
   * 
   * @param string $name The name to set to the project.
   */
  public function setName(string $name) {
    $this->name = $name;
    
    return $this;
  }
  
  /**
   * Get the description of the project.
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
   * Get the Image object associated to the Project.
   * 
   * @return \Tuxi\Portfolio\Entity\Image Returns the Image object associated
   * to the Project.
   */
  public function image(): Image {
    
    return $this->image;
  }
  
  /**
   * Set the Image object to associate with the Project.
   * 
   * @param \Tuxi\Portfolio\Entity\Image $image The Image object to associate
   * with the Project.
   */
  public function setImage(Image $image) {
    $this->image = $image;
    
    return $this;
  }
  
  /**
   * Get the main Link object associated to the Project.
   * 
   * @return \Tuxi\Portfolio\Entity\Link Returns the main Link object
   * associated to the Project.
   */
  public function mainLink(): Link {
    
    return $this->mainLink;
  }
  
  /**
   * Set the main Link object to associate with the Project.
   * 
   * @param \Tuxi\Portfolio\Entity\Link $mainLink The main Link object to
   * associate with the Project.
   */
  public function setMainLink(Link $mainLink) {
    $this->mainLink = $mainLink;
    
    return $this;
  }
  
  /**
   * Get the sources Link object associated to the Project.
   * 
   * @return \Tuxi\Portfolio\Entity\Link Returns the sources Link object
   * associated to the Project.
   */
  public function sourcesLink(): Link {
    
    return $this->sourcesLink;
  }
  
  /**
   * Set the sources Link object to associate with the Project.
   * 
   * @param \Tuxi\Portfolio\Entity\Link $sourcesLink The sources Link object
   * to associate with the Project.
   */
  public function setSourcesLink(Link $sourcesLink) {
    $this->sourcesLink = $sourcesLink;
    
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
