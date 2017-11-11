<?php

namespace Portfolio\Core\Middlewares;

use Portfolio\Core\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of RouterMiddleware
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class RouterMiddleware {
  
  /**
   * @var Router
   */
  private $router;
  
  public function __construct(Router $router) {
    $this->router = $router;
  }
  
  public function __invoke(ServerRequestInterface $request, callable $next) {
    $route = $this->router->match($request);
    
    if (is_null($route)) {
      return $next($request);
    }

    $params = $route->getParams();
    $requestParams = array_reduce(
      array_keys($params),
      function (ServerRequestInterface $request, $key) use ($params) {
        return $request->withAttribute($key, $params[$key]);
      },
        $request
        );
    
    $requestAttr = $requestParams->withAttribute(get_class($route), $route);
    
    return $next($requestAttr);
  }
}
