<?php

namespace Portfolio\Core\Sessions;

/**
 * Description of PhpSession
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ArraySession implements SessionInterface {
  
  private $session = [];
  
  /**
   * {@inheritdoc}
   */
  public function get(string $key, $default = null) {
    if (array_key_exists($key, $this->session)) {
      return $this->session[$key];
    }
    
    return $default;
  }

  /**
   * {@inheritdoc}
   */
  public function set(string $key, $value): void {
    $this->session[$key] = $value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function delete(string $key): void {
    unset($this->session[$key]);
  }
}
