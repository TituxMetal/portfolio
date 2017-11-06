<?php

namespace Portfolio\Modules\Technology\Actions;

use DateTime;
use Portfolio\Core\Actions\CrudActions;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Technology\Entity\Technology;
use Portfolio\Modules\Technology\Table\TechnologyTable;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of TechnologiesCrudAction
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class TechnologiesCrudAction extends CrudActions {
  
  /**
   *
   * @var array
   */
  protected $acceptedParams = [
    'name', 'updated'
  ];
  
  protected $routePrefix = "admin.technologies";
  
  /**
   * @var string
   */
  protected $viewPath = "@admin/admin";
  
  public function __construct(
      RendererInterface $renderer,
      Router $router,
      TechnologyTable $table,
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
   * Returns a new Technology entity with created and updated settings.
   *
   * @return Technology
   */
  protected function getNewEntity(): Technology {
    $item = new Technology();
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
