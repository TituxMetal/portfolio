<?php

namespace Portfolio\Modules\Contact;

use Portfolio\Core\Modules\Module;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Contact\Actions\ContactAction;
use Psr\Container\ContainerInterface;

/**
 * Description of ContactModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class ContactModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';
  
  public function __construct(ContainerInterface $container, Router $router) {
    $container->get(RendererInterface::class)->addPath('contact', __DIR__ . '/resources/templates');
    $router->post('/contact', ContactAction::class, 'post.contact');
  }
  
}
