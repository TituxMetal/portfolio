<?php

namespace Portfolio\Modules\Technology\Entity;

use Portfolio\Core\Entity\Timestamp;

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
}
