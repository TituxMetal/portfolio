<?php

namespace Tests\Core;

use Exception;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of AppTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class AppTest extends TestCase {
  
  /**
   * @var App
   */
  private $app;
  
  public function setUp() {
    $this->app = new App();
  }
  
  public function testApp() {
    $this->app->addModule(get_class($this));
    
    $this->assertEquals([get_class($this)], $this->app->getModule());
  }
  
  public function testAppWithArrayDefinition() {
    $app = new App(['a' => 2]);
    
    $this->assertEquals(2, $app->getContainer()->get('a'));
  }
  
  public function testPipe() {
    $middleware = $this->getMockBuilder(MiddlewareInterface::class)->getMock();
    $middleware2 = $this->getMockBuilder(MiddlewareInterface::class)->getMock();
    $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
    $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
    
    $middleware->expects($this->once())->method('process')->willReturn($response);
    $middleware2->expects($this->never())->method('process')->willReturn($response);
    $this->assertEquals($response, $this->app->pipe($middleware)->run($request));
  }
  
  public function testPipeWithClosure() {
    $middleware = $this->getMockBuilder(MiddlewareInterface::class)->getMock();
    $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
    $request = $this->getMockBuilder(ServerRequestInterface::class)->getMock();
    
    $middleware->expects($this->once())->method('process')->willReturn($response);
    
    $this->app
      ->pipe(function ($request, $next) {
        return $next($request);
      })
      ->pipe($middleware);
    
    $this->assertEquals($response, $this->app->run($request));
  }
  
  public function testPipeWithoutMiddleware() {
    $this->expectException(Exception::class);
    
    $this->app->run($this->getMockBuilder(ServerRequestInterface::class)->getMock());
  }
  
}
