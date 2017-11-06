<?php

namespace Portfolio\Core\TwigExtensions;

use Pagerfanta\Pagerfanta;
use Pagerfanta\View\DefaultView;
use Portfolio\Core\Routing\Router;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of PagerfantaExtension
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class PagerfantaExtension extends Twig_Extension {

  /**
   * @var Router
   */
  private $router;

  public function __construct(Router $router) {
    $this->router = $router;
  }
  
  public function getFunctions() {
    
    return [
      new Twig_SimpleFunction('paginate', [$this, 'paginate'], ['is_safe' => ['html']])
    ];
  }
  
  public function paginate(
      Pagerfanta $paginatedResults,
      string $route,
      array $routerParams = [],
      array $queryArgs = []
  ): string {
    $view = new DefaultView();
    
    return $view->render(
      $paginatedResults,
      function (int $page) use ($route, $routerParams, $queryArgs) {
        if ($page > 1) {
          $queryArgs['page'] = $page;
        }
        return $this->router->generateUri($route, $routerParams, $queryArgs);
      }
    );
  }
}
