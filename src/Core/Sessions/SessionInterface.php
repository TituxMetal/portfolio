<?php

namespace Portfolio\Core\Sessions;

/**
 * Description of SessionInterface
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
interface SessionInterface {
  
  /**
   * Get an item in session
   *
   * @param string $key
   * @param mixed $default
   */
  public function get(string $key, $default = null);
  
  /**
   * Set an item in session
   *
   * @param string $key
   * @param mixed $value
   */
  public function set(string $key, $value): void;
  
  /**
   * Delete a key in session
   *
   * @param string $key
   * @return void
   */
  public function delete(string $key): void;
}
