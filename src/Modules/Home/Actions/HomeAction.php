<?php

namespace Portfolio\Modules\Home\Actions;

use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Knowledge\Table\KnowledgeTable;
use Portfolio\Modules\Project\Table\ProjectTable;
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
   * @var ProjectTable
   */
  private $project;

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
    TechnologyTable $technology,
    ProjectTable $project
  ) {
    $this->renderer = $renderer;
    $this->knowledge = $knowledge;
    $this->technology = $technology;
    $this->project = $project;
  }
  
  public function __invoke(): string {
    $knowledges = $this->knowledge->getAll();
    $technologies = $this->technology->getAll();
    $projects = $this->project->getAll();
    
    return $this->renderer->render('@home/index', compact('knowledges', 'technologies', 'projects'));
  }
}
