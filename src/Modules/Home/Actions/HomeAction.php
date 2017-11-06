<?php

namespace Portfolio\Modules\Home\Actions;

use PDO;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Knowledge\Table\KnowledgeTable;

/**
 * Description of HomeAction
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class HomeAction {

  /**
   * @var KnowledgeTable
   */
  private $table;

  /**
   * @var PDO
   */
  private $pdo;

  /**
   * @var RendererInterface
   */
  private $renderer;

  public function __construct(RendererInterface $renderer, PDO $pdo, KnowledgeTable $table) {
    $this->renderer = $renderer;
    $this->pdo = $pdo;
    $this->table = $table;
  }
  
  public function __invoke(): string {
    $knowledges = $this->table
      ->findForHome();
    
    return $this->renderer->render('@home/index', compact('knowledges'));
  }
}
