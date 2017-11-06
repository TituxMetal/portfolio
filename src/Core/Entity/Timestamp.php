<?php

namespace Portfolio\Core\Entity;

use DateTime;

/**
 * Description of Timestamp
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
trait Timestamp {
  
  /**
   * @var DateTime|null
   */
  private $updated;
  
  /**
   * @var DateTime|null
   */
  private $created;
  
  /**
   * @return DateTime|null
   */
  public function getUpdated() {
    
    return $this->updated;
  }
  
  /**
   * @return DateTime|null
   */
  public function getCreated() {
    
    return $this->created;
  }
  
  /**
   *
   * @param DateTime|string|null $datetime
   */
  public function setUpdated($datetime): void {
    $this->updated = (is_string($datetime)) ? new DateTime($datetime) : $datetime;
  }
  
  /**
   *
   * @param DateTime|string|null $datetime
   */
  public function setCreated($datetime): void {
    $this->created = (is_string($datetime)) ? new DateTime($datetime) : $datetime;
  }
}
