<?php

namespace Portfolio\Core\Templating;

use Portfolio\Core\Templating\RendererInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Description of TwigRenderer
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TwigRenderer implements RendererInterface {
  
  /**
   * @var Twig_Loader_Filesystem
   */
  private $loader;
  
  /**
   * @var Twig_Environment
   */
  private $twig;

  public function __construct(Twig_Loader_Filesystem $loader, Twig_Environment $twig) {
    $this->loader = $loader;
    $this->twig = $twig;
  }

  public function addGlobal(string $key, $value): void {
    
    $this->twig->addGlobal($key, $value);
  }

  public function addPath(string $namespace, $path = null): void {
    
    $this->loader->addPath($path, $namespace);
  }

  public function render(string $view, array $params = []): string {
    
    return $this->twig->render($view . '.twig', $params);
  }
}
