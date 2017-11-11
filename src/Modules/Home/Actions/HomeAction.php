<?php

namespace Portfolio\Modules\Home\Actions;

use PDO;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Knowledge\Table\KnowledgeTable;
use Portfolio\Modules\Technology\Table\TechnologyTable;

/**
 * Description of HomeAction
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class HomeAction {

  /**
   * @var KnowledgeTable
   */
  private $knowledge;

  /**
   * @var TechnologyTable
   */
  private $technology;

  /**
   * @var RendererInterface
   */
  private $renderer;

  public function __construct(
    RendererInterface $renderer,
    KnowledgeTable $knowledge,
    TechnologyTable $technology
  ) {
    $this->renderer = $renderer;
    $this->knowledge = $knowledge;
    $this->technology = $technology;
  }
  
  public function __invoke(): string {
    $knowledges = $this->knowledge->findForHome();
    $technologies = $this->technology->findForHome();
    
    return $this->renderer->render('@home/index', compact('knowledges', 'technologies'));
  }
}
