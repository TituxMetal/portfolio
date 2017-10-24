<?php

namespace Tests\Core\Middleware;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Middlewares\RouterMiddleware;
use Portfolio\Core\Routing\Route;
use Portfolio\Core\Routing\Router;

/**
 * Description of RouterMiddlewareTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class RouterMiddlewareTest extends TestCase {
  
  public function makeMiddleware($route) {
    $router = $this->getMockBuilder(Router::class)->getMock();
    $router->method('match')->willReturn($route);
    
    return new RouterMiddleware($router);
  }
  
  public function testPassParameters() {
    $route = new Route('test', 'method', ['id' => 1]);
    $middleware = $this->makeMiddleware($route);
    $test = function ($request) use ($route) {
      $this->assertEquals(1, $request->getAttribute('id'));
      $this->assertEquals($route, $request->getAttribute(get_class($route)));
      
      return new Response();
    };
    
    call_user_func_array($middleware, [new ServerRequest('GET', '/test'), $test]);
  }
  
  public function testCallNext() {
    $middleware = $this->makeMiddleware(null);
    $response = new Response();
    $test = function ($request) use ($response) {
      return $response;
    };
    
    $this->assertEquals($response, call_user_func_array($middleware, [new ServerRequest('GET', '/test'), $test]));
  }
  
}
