<?php

namespace Portfolio\Modules\Admin;

use Portfolio\Core\Modules\Module;
use Portfolio\Core\Templating\RendererInterface;

/**
 * Description of AdminModule
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class AdminModule extends Module {
  
  const DEFINITIONS = __DIR__ . '/config.php';

  public function __construct(RendererInterface $renderer) {
    $renderer->addPath('admin', __DIR__ . '/resources/templates');
  }
}
