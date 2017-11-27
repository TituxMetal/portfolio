<?php

namespace Portfolio\Core\Sessions;

/**
 * Description of FlashService
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class FlashService {

  /**
   * @var SessionInterface
   */
  private $session;
  
  /**
   * @var string
   */
  private $sessionKey = 'flash';
  
  /**
   * @var string[]
   */
  private $messages;

  /**
   * @param SessionInterface $session
   */
  public function __construct(SessionInterface $session) {
    $this->session = $session;
  }
  
  /**
   * Add a success message in flash session
   *
   * @param string $message
   */
  public function success(string $message) {
    $this->add('success', $message);
  }
  
  /**
   * Add an error message in flash session
   *
   * @param string $message
   */
  public function error(string $message) {
    $this->add('error', $message);
  }
  
  /**
   * Add a messages key with an array of messages
   * 
   * @param array $messages
   */
  public function messages(array $messages) {
    $this->add('messages', $messages);
  }
  
  /**
   * Get a message in the session flash key
   *
   * @param string $type
   * @return string|null
   */
  public function get(string $type) {
    if (is_null($this->messages)) {
      $this->messages = $this->session->get($this->sessionKey, []);
    }
    $this->session->delete($this->sessionKey);
    
    if (array_key_exists($type, $this->messages)) {
      
      return $this->messages[$type];
    }
    
    return null;
  }
  
  /**
   * Add a key type with the message in the session
   * 
   * @param string $type
   * @param array|string $message
   */
  private function add(string $type, $message) {
    $flash = $this->session->get($this->sessionKey, []);
    $flash[$type] = $message;
    $this->session->set($this->sessionKey, $flash);
  }
}
