<?php

namespace Portfolio\Modules\Knowledge\Entity;

use Portfolio\Core\Entity\Timestamp;

/**
 * Description of Knowledge
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Knowledge {
  
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
   * Get the id of the knowledge
   *
   * @return int|null
   */
  public function getId() {
    
    return $this->id;
  }
  
  /**
   * Get the name of the knowledge
   *
   * @return string|null
   */
  public function getName() {
    
    return $this->name;
  }
  
  /**
   * Set the id for the knowledge
   *
   * @param int|null $id
   */
  public function setId($id): void {
    $this->id = $id;
  }
  
  /**
   * Set the name of the knowledge
   *
   * @param string|null $name
   */
  public function setName($name): void {
    $this->name = $name;
  }
}
