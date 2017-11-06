<?php

namespace Portfolio\Core\Middlewares;

use Exception;
use GuzzleHttp\Psr7\Response;
use Portfolio\Core\Routing\Route;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of DispatcherMiddleware
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class DispatcherMiddleware {

  /**
   * @var ContainerInterface
   */
  private $container;

  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }
  
  public function __invoke(ServerRequestInterface $request, callable $next) {
    $route = $request->getAttribute(Route::class);
    
    if (is_null($route)) {
      return $next($request);
    }
    
    $callback = $route->getCallback();
    
    if (is_string($callback)) {
      $callback = $this->container->get($callback);
    }
    
    $response = call_user_func_array($callback, [$request]);
    
    if (is_string($response)) {
      return new Response(200, [], $response);
    }

    if ($response instanceof ResponseInterface) {
      return $response;
    }

    throw new Exception('The response MUST be a string or an instance of ResponseInterface.');
  }
}
