<?php

namespace Portfolio\Core\Templating;

/**
 * Description of HomeModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
interface RendererInterface {
  
  /**
   * Adds global variables to all views
   *
   * @param string $key
   * @param mixed $value
   */
  public function addGlobal(string $key, $value): void;
  
  /**
   * Add a path for loading views
   *
   * @param string $namespace
   * @param string|null $path
   */
  public function addPath(string $namespace, $path = null): void;
  
  /**
   * Render the view $view with parameters $params
   *
   * @param string $view
   * @param array $params
   * @return string
   */
  public function render(string $view, array $params = []): string;
}
