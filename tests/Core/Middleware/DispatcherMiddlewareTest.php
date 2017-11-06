<?php

namespace Tests\Core\Middleware;

use GuzzleHttp\Psr7\ServerRequest;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Middlewares\DispatcherMiddleware;
use Portfolio\Core\Routing\Route;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Description of DispatcherMiddlewareTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class DispatcherMiddlewareTest extends TestCase {
  
  public function testDispatchTheCallback() {
    $callback = function () {
      return 'Test';
    };
    $route = new Route('test', $callback, []);
    $request = (new ServerRequest('GET', '/test'))->withAttribute(Route::class, $route);
    $container = $this->getMockBuilder(ContainerInterface::class)->getMock();
    $dispatcher = new DispatcherMiddleware($container);
    $response = call_user_func_array($dispatcher, [$request, function () {}]);
    
    $this->assertEquals('Test', (string) $response->getBody());
  }
  
  public function testCallNextIfNoRoutes() {
    $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
    $delegate = $this->getMockBuilder(DelegateInterface::class)->getMock();
    $container = $this->getMockBuilder(ContainerInterface::class)->getMock();
    
    $delegate->expects($this->once())->method('process')->willReturn($response);
    
    $request = new ServerRequest('GET', '/test');
    $dispatcher = new DispatcherMiddleware($container);
    
    $this->assertEquals($response, call_user_func_array($dispatcher, [$request, [$delegate, 'process']]));
  }
}
