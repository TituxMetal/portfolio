<?php

namespace Portfolio\Core\Sessions;

/**
 * Description of PhpSession
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class PhpSession implements SessionInterface {
  
  /**
   * {@inheritdoc}
   */
  public function get(string $key, $default = null) {
    $this->ensureStarted();
    if (array_key_exists($key, $_SESSION)) {
      return $_SESSION[$key];
    }
    
    return $default;
  }

  /**
   * {@inheritdoc}
   */
  public function set(string $key, $value): void {
    $this->ensureStarted();
    $_SESSION[$key] = $value;
  }
  
  /**
   * {@inheritdoc}
   */
  public function delete(string $key): void {
    $this->ensureStarted();
    unset($_SESSION[$key]);
  }
  
  /**
   * Ensure that the php session is started
   */
  private function ensureStarted() {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }
}
