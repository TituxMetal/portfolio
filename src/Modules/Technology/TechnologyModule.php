<?php

namespace Portfolio\Modules\Technology;

use Portfolio\Core\Modules\Module;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Technology\Actions\TechnologiesCrudAction;
use Psr\Container\ContainerInterface;

/**
 * Description of TechnologyModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TechnologyModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';
  
  const MIGRATIONS = __DIR__ . '/storage/migrations';
  
  const SEEDS = __DIR__ . '/storage/seeds';

  public function __construct(ContainerInterface $container) {
    $technologyPrefix = $container->get('technology.prefix');
    $container->get(RendererInterface::class)->addPath('technologies', __DIR__ . '/resources/templates');
    
    $router = $container->get(Router::class);
    
    if ($container->has('admin.prefix')) {
      $adminPrefix = $container->get('admin.prefix');
      $router->crud($adminPrefix . $technologyPrefix, TechnologiesCrudAction::class, 'admin.technologies');
    }
  }
}
