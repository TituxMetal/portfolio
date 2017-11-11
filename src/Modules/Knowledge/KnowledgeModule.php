<?php

namespace Portfolio\Modules\Knowledge;

use Portfolio\Core\Modules\Module;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Knowledge\Actions\KnowledgesCrudAction;
use Psr\Container\ContainerInterface;

/**
 * Description of KnowledgeModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class KnowledgeModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';
  
  const MIGRATIONS = __DIR__ . '/storage/migrations';
  
  const SEEDS = __DIR__ . '/storage/seeds';

  public function __construct(ContainerInterface $container) {
    $knowledgePrefix = $container->get('knowledge.prefix');
    $container->get(RendererInterface::class)->addPath('knowledges', __DIR__ . '/resources/templates');
    
    $router = $container->get(Router::class);
    
    if ($container->has('admin.prefix')) {
      $adminPrefix = $container->get('admin.prefix');
      $router->crud($adminPrefix . $knowledgePrefix, KnowledgesCrudAction::class, 'admin.knowledges');
    }
  }
}
