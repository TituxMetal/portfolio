<?php

namespace Portfolio\Core\Routing;

/**
 * Description of Route
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Route {

  /**
   * @var callable
   */
  private $callback;

  /**
   * @var string
   */
  private $name;

  /**
   * @var array
   */
  private $params;

  /**
   * @param string $name
   * @param string|callable $callback
   * @param array $params
   */
  public function __construct(string $name, $callback, array $params = []) {
    $this->name = $name;
    $this->callback = $callback;
    $this->params = $params;
  }
  
  public function getName(): string {
    
    return $this->name;
  }
  
  /**
   *
   * @return string|callable
   */
  public function getCallback() {
    
    return $this->callback;
  }
  
  public function getParams(): array {
    
    return $this->params;
  }
}
