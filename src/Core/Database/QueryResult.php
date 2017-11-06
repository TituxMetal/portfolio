<?php

namespace Portfolio\Core\Database;

use ArrayAccess;
use Iterator;

/**
 * Description of QueryResult
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class QueryResult implements ArrayAccess, Iterator {
  
  /**
   * @var string|null
   */
  private $entity;
  
  /**
   * @var array
   */
  private $hydratedRecords = [];
  
  /**
   * @var int
   */
  private $index = 0;
  
  /**
   * @var array
   */
  private $records;
  
  /**
   * @param array $records
   * @param string|null $entity
   */
  public function __construct(array $records, $entity = null) {
    $this->records = $records;
    $this->entity = $entity;
  }
  
  /**
   * Get an item on defined $index
   *
   * @param int $index
   * @return mixed
   */
  public function get(int $index) {
    
    if ($this->entity) {
      if (!isset($this->hydratedRecords[$index])) {
        $this->hydratedRecords[$index] = Hydrator::hydrate($this->records[$index], $this->entity);
      }
      
      return $this->hydratedRecords[$index];
    }
    
    return $this->entity;
  }
  
  public function toArray(): array {
    $records = [];
    
    foreach ($this->records as $k => $v) {
      $records[] = $this->get($k);
    }
    
    return $records;
  }
  
  /**
   * @inherit
   */
  public function current() {
    
    return $this->get($this->index);
  }
  
  /**
   * @inherit
   */
  public function key() {
    
    return $this->index;
  }
  
  /**
   * @inherit
   */
  public function next(): void {
    $this->index++;
  }
  
  /**
   * @inherit
   */
  public function offsetExists($offset): bool {
    
    return isset($this->records[$offset]);
  }
  
  /**
   * @inherit
   */
  public function offsetGet($offset) {
    
    return $this->get($offset);
  }
  
  /**
   * @inherit
   */
  public function offsetSet($offset, $value): void {
    throw new Exception("Can't alter records");
  }
  
  /**
   * @inherit
   */
  public function offsetUnset($offset): void {
    throw new Exception("Can't alter records");
  }
  
  /**
   * @inherit
   */
  public function rewind(): void {
    $this->index = 0;
  }
  
  /**
   * @inherit
   */
  public function valid(): bool {
    
    return isset($this->records[$this->index]);
  }
}
