<?php

namespace Portfolio\Modules\Project;

use Portfolio\Core\Modules\Module;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Templating\RendererInterface;
use Psr\Container\ContainerInterface;

/**
 * Description of ProjectModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ProjectModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';
  
  const MIGRATIONS = __DIR__ . '/storage/migrations';
  
  const SEEDS = __DIR__ . '/storage/seeds';

  public function __construct(ContainerInterface $container) {
    /*
    $technologyPrefix = $container->get('project.prefix');
    $container->get(RendererInterface::class)->addPath('projects', __DIR__ . '/resources/templates');
    
    $router = $container->get(Router::class);
    
    if ($container->has('admin.prefix')) {
      $adminPrefix = $container->get('admin.prefix');
      $router->crud($adminPrefix . $technologyPrefix, ProjectCrudAction::class, 'admin.projects');
    }
    */
  }
}
