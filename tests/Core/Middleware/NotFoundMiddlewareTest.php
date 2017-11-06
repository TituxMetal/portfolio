<?php

namespace Tests\Core\Middleware;

use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Middlewares\NotFoundMiddleware;

/**
 * Description of NotFoundMiddlewareTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class NotFoundMiddlewareTest extends TestCase {
  
  public function testNotFound() {
    $request = new ServerRequest('GET', '/test');
    $middleware = new NotFoundMiddleware();
    $response = call_user_func_array($middleware, [$request, function () {}]);
    
    $this->assertEquals(404, $response->getStatusCode());
  }
}
