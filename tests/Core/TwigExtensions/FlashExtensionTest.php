<?php

namespace Tests\Core\TwigExtensions;

use PHPUnit\Framework\TestCase;
use Portfolio\Core\Sessions\ArraySession;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Sessions\SessionInterface;
use Portfolio\Core\TwigExtensions\FlashExtension;

/**
 * Description of FlashExtensionTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class FlashExtensionTest extends TestCase {
  
  /**
   *
   * @var FlashExtension
   */
  private $flashExt;
  
  /**
   *
   * @var FlashService
   */
  private $flashService;
  
  /**
   *
   * @var SessionInterface
   */
  private $session;
  
  public function setUp() {
    $this->session = new ArraySession();
    $this->flashService = new FlashService($this->session);
    $this->flashExt = new FlashExtension($this->flashService, $this->session);
  }
  
  public function testGetFlash() {
    $this->flashService->error("Test");
    
    $this->assertEquals("Test", $this->flashExt->getFlash('error'));
  }
  
  public function testGetSession() {
    $this->session->set('messages', ['name' => 'name error', 'email' => 'email error']);
    
    $this->assertEquals(
      ['name' => 'name error', 'email' => 'email error'],
      $this->flashExt->getSession('messages')
    );
  }
  
}
