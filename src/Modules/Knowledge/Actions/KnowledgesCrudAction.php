<?php

namespace Portfolio\Modules\Knowledge\Actions;

use DateTime;
use Portfolio\Core\Actions\CrudActions;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Knowledge\Entity\Knowledge;
use Portfolio\Modules\Knowledge\Table\KnowledgeTable;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of KnowledgesCrudAction
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class KnowledgesCrudAction extends CrudActions {
  
  /**
   *
   * @var array
   */
  protected $acceptedParams = [
    'name', 'updated'
  ];
  
  protected $routePrefix = "admin.knowledges";
  
  /**
   * @var string
   */
  protected $viewPath = "@admin/admin";
  
  public function __construct(
      RendererInterface $renderer,
      Router $router,
      KnowledgeTable $table,
      FlashService $flash
  ) {
    parent::__construct($renderer, $router, $table, $flash);
  }
  
  protected function prePersist(ServerRequestInterface $request, $item): array {
    $now = date('Y-m-d H:i:s');
    $requestParams = array_merge(
      $request->getParsedBody(),
      ['updated' => $now]
    );
    
    if (is_null($item->getId())) {
      $requestParams['created'] = $now;
      $this->acceptedParams[] = 'created';
    }
    
    $params = array_filter($requestParams, function ($key) {
      return in_array($key, $this->acceptedParams);
    }, ARRAY_FILTER_USE_KEY);
    
    return $params;
  }
  
  /**
   * Returns a new Knowledge entity with created and updated settings.
   *
   * @return Knowledge
   */
  protected function getNewEntity(): Knowledge {
    $item = new Knowledge();
    $item->setCreated(new DateTime());
    
    return $item;
  }
  
  protected function getValidator(ServerRequestInterface $request) {
    $validator = parent::getValidator($request)
      ->required('name')
      ->length('name', 3, 56);
    
    return $validator;
  }
}
