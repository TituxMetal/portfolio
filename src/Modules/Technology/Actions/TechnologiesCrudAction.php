<?php

namespace Portfolio\Modules\Technology\Actions;

use DateTime;
use Portfolio\Core\Actions\CrudActions;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Modules\Common\Table\PictureTable;
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
    'name', 'pictureId', 'updated'
  ];
  
  /**
   * @var PictureTable
   */
  private $pictureTable;
  
  protected $routePrefix = "admin.technologies";
  
  /**
   * @var string
   */
  protected $viewPath = "@technologies/admin";
  
  public function __construct(
      RendererInterface $renderer,
      Router $router,
      TechnologyTable $table,
      PictureTable $pictureTable,
      FlashService $flash
  ) {
    parent::__construct($renderer, $router, $table, $flash);
    $this->pictureTable = $pictureTable;
  }
  
  protected function prePersist(ServerRequestInterface $request, $item): array {
    $now = date('Y-m-d H:i:s');
    
    $requestParams = array_merge(
      $request->getParsedBody(),
      ['updated' => $now]
    );
    
    $requestParams['created'] = $now;

    $relatedParams = array_filter($requestParams, function ($key) {
      return in_array($key, $this->pictureTable->fillable);
    }, ARRAY_FILTER_USE_KEY);
    
    if (!$item->getPictureId()) {
      $this->pictureTable->fillable[] = 'created';
      $this->pictureTable->insert($relatedParams);
      $item->setPictureId($this->pictureTable->getLastInsertId());
      $this->table->fillable[] = 'created';
    } else {
      unset($relatedParams['created']);
      $this->pictureTable->update($item->getPictureId(), $relatedParams);
    }
    $requestParams['pictureId'] = $item->getPictureId();
    
    $currentParams = array_filter($requestParams, function ($key) {
      return in_array($key, $this->table->fillable);
    }, ARRAY_FILTER_USE_KEY);
    
    return $currentParams;
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
      ->required('title')
      ->length('title', 3, 56)
      ->length('name', 3, 56);
    
    return $validator;
  }
}
