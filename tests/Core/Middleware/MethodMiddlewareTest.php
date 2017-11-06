<?php

namespace Tests\Core\Middleware;

use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Middlewares\MethodMiddleware;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of MethodMiddleware
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class MethodMiddlewareTest extends TestCase {
  
  /**
   * @var MethodMiddleware
   */
  private $middleware;
  
  public function setUp() {
    $this->middleware = new MethodMiddleware();
  }
  
  public function testAddMethod() {
    $request = (new ServerRequest('POST', '/test'))
      ->withParsedBody(['_method' => 'DELETE']);
    
    call_user_func_array($this->middleware, [$request, function (ServerRequestInterface $request) {
      $this->assertEquals('DELETE', $request->getMethod());
    }]);
  }
}
