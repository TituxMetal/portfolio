<?php

namespace Portfolio\Core\Routing;

use Portfolio\Core\Routing\Route;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Description of Router
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class Router {
  
  /**
   * @var FastRouteRouter
   */
  private $router;
  
  public function __construct() {
    $this->router = new FastRouteRouter();
  }
  
  /**
   *
   * @param string $path
   * @param string|callable $callback
   * @param string $name
   */
  public function get(string $path, $callback, string $name) {
    $this->router->addRoute(new ZendRoute($path, $callback, ['GET'], $name));
  }
  
  /**
   * @param ServerRequestInterface $request
   * @return Route|null
   */
  public function match(ServerRequestInterface $request) {
    $result = $this->router->match($request);
    
    if ($result->isSuccess()) {
      return new Route(
        $result->getMatchedRouteName(),
        $result->getMatchedMiddleware(),
        $result->getMatchedParams()
      );
    }
    
    return null;
  }
  
  public function generateUri(string $name, array $params): string {
    
    return $this->router->generateUri($name, $params);
  }
}
