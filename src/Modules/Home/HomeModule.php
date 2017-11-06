<?php

namespace Portfolio\Modules\Home;

use Portfolio\Core\Modules\Module;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Home\Actions\HomeAction;
use Psr\Container\ContainerInterface;

/**
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class HomeModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';

  public function __construct(ContainerInterface $container) {
    $homePrefix = $container->get('home.prefix');
    $container->get(RendererInterface::class)->addPath('home', __DIR__ . '/resources/templates');
    
    $router = $container->get(Router::class);
    $router->get($homePrefix, HomeAction::class, 'portfolio.home');
  }
}
