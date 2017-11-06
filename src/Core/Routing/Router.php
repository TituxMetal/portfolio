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
   * Add a route for get requests
   *
   * @param string $path
   * @param string|callable $callback
   * @param string|null $name
   */
  public function get(string $path, $callback, $name = null) {
    $this->router->addRoute(new ZendRoute($path, $callback, ['GET'], $name));
  }
  
  /**
   * Add a route for post requests
   *
   * @param string $path
   * @param string|callable $callback
   * @param string|null $name
   */
  public function post(string $path, $callback, $name = null) {
    $this->router->addRoute(new ZendRoute($path, $callback, ['POST'], $name));
  }
  
  /**
   * Add a route for delete requests
   *
   * @param string $path
   * @param string|callable $callback
   * @param string|null $name
   */
  public function delete(string $path, $callback, $name = null) {
    $this->router->addRoute(new ZendRoute($path, $callback, ['DELETE'], $name));
  }
  
  /**
   * Add a route for any (get, post, put, patch, delete) requests
   *
   * @param string $path
   * @param string|callable $callback
   * @param string|null $name
   */
  public function any(string $path, $callback, $name = null) {
    $this->router->addRoute(
      new ZendRoute(
          $path,
        $callback,
        ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
        $name
      )
    );
  }
  
  public function crud(string $prefixPath, $callable, $prefixName = null) {
    $this->get("$prefixPath", $callable, "$prefixName.index");
    $this->get("$prefixPath/new", $callable, "$prefixName.create");
    $this->post("$prefixPath/new", $callable);
    $this->get("$prefixPath/{id:\d+}", $callable, "$prefixName.edit");
    $this->post("$prefixPath/{id:\d+}", $callable);
    $this->delete("$prefixPath/{id:\d+}", $callable, "$prefixName.delete");
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
  
  public function generateUri(string $name, array $params = [], array $queryParams = []): string {
    $uri = $this->router->generateUri($name, $params);
    
    if (!empty($queryParams)) {
      return $uri . '?' . http_build_query($queryParams);
    }
    
    return $uri;
  }
}
