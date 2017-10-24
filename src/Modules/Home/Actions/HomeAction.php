<?php

namespace Portfolio\Modules\Home\Actions;

use Portfolio\Core\Templating\RendererInterface;

/**
 * Description of HomeAction
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class HomeAction {

  /**
   * @var RendererInterface
   */
  private $renderer;

  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }
  
  public function __invoke(): string {
    
    return $this->renderer->render('@home/index');
  }
}
