<?php

namespace Tests\Core\Middleware;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Middlewares\TrailingSlashMiddleware;

/**
 * Description of NotFoundMiddlewareTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TrailingSlashMiddlewareTest extends TestCase {
  
  public function testRedirectIfTrailingSlash() {
    $request = new ServerRequest('GET', '/test/');
    $middleware = new TrailingSlashMiddleware();
    $response = call_user_func_array($middleware, [$request, function () {}]);
    
    $this->assertEquals(301, $response->getStatusCode());
    $this->assertEquals(['/test'], $response->getHeader('Location'));
  }
  
  public function testCallNextIfNoSlash() {
    $request = new ServerRequest('GET', '/test');
    $response = new Response();
    $middleware = new TrailingSlashMiddleware();
    $callback = function () use ($response) {
      return $response;
    };
    
    $this->assertEquals($response, call_user_func_array($middleware, [$request, $callback]));
  }
}
