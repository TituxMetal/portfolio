<?php

namespace Tests\Core\Sessions;

use PHPUnit\Framework\TestCase;
use Portfolio\Core\Sessions\ArraySession;
use Portfolio\Core\Sessions\FlashService;

/**
 * Description of FlashServiceTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class FlashServiceTest extends TestCase {

  /**
   * @var ArraySession
   */
  private $session;
  
  /**
   * @var FlashService
   */
  private $flashService;

  public function setUp() {
    $this->session = new ArraySession();
    $this->flashService = new FlashService($this->session);
  }
  
  public function testFlashReturnsNull() {
    $this->assertNull($this->flashService->get('success'));
  }
  
  public function testSuccessFlash() {
    $this->flashService->success('Success message');
    
    $this->assertEquals(['success' => 'Success message'], $this->session->get('flash'));
  }
  
  public function testErrorFlash() {
    $this->flashService->error('Error message');
    
    $this->assertEquals(['error' => 'Error message'], $this->session->get('flash'));
  }
  
  public function testDeleteFlashAfterGettingIt() {
    $this->flashService->success('Demo');
    $this->assertEquals('Demo', $this->flashService->get('success'));
    $this->assertNull($this->session->get('flash'));
    $this->assertEquals('Demo', $this->flashService->get('success'));
    $this->assertEquals('Demo', $this->flashService->get('success'));
  }
}
