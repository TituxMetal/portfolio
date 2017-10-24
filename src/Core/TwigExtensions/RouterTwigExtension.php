<?php

namespace Portfolio\Core\TwigExtensions;

use Portfolio\Core\Routing\Router;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of RouterTwigExtension
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class RouterTwigExtension extends Twig_Extension {

  /**
   * @var Router
   */
  private $router;

  public function __construct(Router $router) {
    $this->router = $router;
  }
  
  public function getFunctions() {
    
    return [
      new Twig_SimpleFunction('path', [$this, 'pathFor'])
    ];
  }
  
  public function pathFor(string $pathName, array $params = []): string {
    
    return $this->router->generateUri($pathName, $params);
  }
}
