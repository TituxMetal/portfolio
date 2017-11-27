<?php

namespace Portfolio\Core\TwigExtensions;

use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Sessions\SessionInterface;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of FlashExtension
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class FlashExtension extends Twig_Extension {

  /**
   * @var SessionInterface
   */
  private $session;

  /**
   * @var FlashService
   */
  private $flashService;

  public function __construct(FlashService $flashService, SessionInterface $session) {
    $this->flashService = $flashService;
    $this->session = $session;
  }
  
  public function getFunctions() {
    
    return [
      new Twig_SimpleFunction('flash', [$this, 'getFlash']),
      new Twig_SimpleFunction('session', [$this, 'getSession']),
    ];
  }
  
  /**
   * Get the flash message in $type key
   * 
   * @param string $type
   * @return array|string|null
   */
  public function getFlash($type) {
    
    return $this->flashService->get($type);
  }
  
  /**
   * Get a session key
   * 
   * @param string $key
   * @return array
   */
  public function getSession($key) {
    
    return $this->session->get($key);
  }
}
