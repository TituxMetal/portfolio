<?php

namespace Portfolio\Core\Templating;

use Portfolio\Core\Templating\TwigRenderer;
use Psr\Container\ContainerInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Description of TwigRendererFactory
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TwigRendererFactory {
  
  public function __invoke(ContainerInterface $container): TwigRenderer {
    $viewPath = $container->get('views.path');
    $loader = new Twig_Loader_Filesystem($viewPath);
    $twig = new Twig_Environment($loader);
    
    if ($container->has('twig.extensions')) {
      foreach ($container->get('twig.extensions') as $extension) {
        $twig->addExtension($extension);
      }
    }
    
    return new TwigRenderer($loader, $twig);
  }
}
