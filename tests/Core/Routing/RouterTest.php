<?php

namespace Tests\Core\Routing;

use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Routing\Router;

/**
 * Description of RouterTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class RouterTest extends TestCase {
  
  /**
   * @var Router
   */
  private $router;
  
  public function setUp() {
    $this->router = new Router();
  }
  
  public function testGetMethod() {
    $request = new ServerRequest('GET', '/demo');
    $this->router->get('/demo', function () {
      return 'Test demo'; }, 'demo');
    $route = $this->router->match($request);
    
    $this->assertEquals('demo', $route->getName());
    $this->assertEquals('Test demo', call_user_func_array($route->getCallback(), [$request]));
  }
  
  public function testGetMethodIfUriNotExists() {
    $request = new ServerRequest('GET', '/demo');
    $this->router->get('/test', function () {
      return 'Test demo'; }, 'demo');
    $route = $this->router->match($request);
    
    $this->assertNull($route);
  }
  
  public function testGetMethodWithParameters() {
    $request = new ServerRequest('GET', '/demo/test-slug-2');
    $this->router->get('/demo', function () {
      return 'lorem ipsum'; }, 'demo');
    $this->router->get('/demo/{slug:[a-z0-9\-]+}-{id:\d}', function () {
      return 'Demo with slug'; }, 'demo.show');
    $route = $this->router->match($request);
    
    $this->assertEquals('demo.show', $route->getName());
    $this->assertEquals('Demo with slug', call_user_func_array($route->getCallback(), [$request]));
    $this->assertEquals(['slug' => 'test-slug', 'id' => '2'], $route->getParams());
    
    $invalidRoute = $this->router->match(new ServerRequest('GET', '/demo/demo_slug-2'));
    
    $this->assertEquals(null, $invalidRoute);
  }
  
  public function testGenerateUri() {
    $this->router->get('/demo', function () {
      return 'lorem ipsum'; }, 'demo');
    $this->router->get('/demo/{slug:[a-z0-9\-]+}-{id:\d}', function () {
      return 'Demo with slug'; }, 'demo.show');
    $uri = $this->router->generateUri('demo.show', ['slug' => 'demo-slug', 'id' => '2']);
    
    $this->assertEquals('/demo/demo-slug-2', $uri);
  }
}
