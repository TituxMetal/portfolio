<?php

namespace Portfolio\Core\Actions;

use Portfolio\Core\Database\Hydrator;
use Portfolio\Core\Database\Table;
use Portfolio\Core\Helpers\RouterAware;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Core\Validation\Validator;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of CrudActions
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class CrudActions {
  
  use RouterAware;
  
  /**
   *
   * @var array
   */
  protected $acceptedParams = [];

  /**
   * @var FlashService
   */
  protected $flash;
  
  /**
   * @var array
   */
  protected $messages = [
    'create' => "L'élément à bien été créé",
    'edit' => "L'élément à bien été modifié",
    'delete' => "L'élément à bien été supprimé",
  ];

  /**
   * @var RendererInterface
   */
  protected $renderer;
  
  /**
   * @var string
   */
  protected $routePrefix;

  /**
   * @var Table
   */
  protected $table;
  
  /**
   * @var string
   */
  protected $viewPath;
  
  public function __construct(
      RendererInterface $renderer,
      Router $router,
      Table $table,
      FlashService $flash
  ) {
    $this->renderer = $renderer;
    $this->router = $router;
    $this->table = $table;
    $this->flash = $flash;
  }
  
  public function __invoke(ServerRequestInterface $request) {
    $this->renderer->addGlobal('viewPath', $this->viewPath);
    $this->renderer->addGlobal('routePrefix', $this->routePrefix);
    
    if ($request->getMethod() === 'DELETE') {
      return $this->delete($request);
    }
    
    if (substr((string) $request->getUri(), -3) === 'new') {
      return $this->create($request);
    }
    
    if ($request->getAttribute('id')) {
      return $this->edit($request);
    }
    
    return $this->index($request);
  }
  
  public function index(ServerRequestInterface $request) {
    $params = $request->getQueryParams();
    $currentPage = $params['page'] ?? 1;
    $items = $this->table->findPaginated(10, $currentPage);
    
    return $this->renderer->render($this->viewPath . '/index', compact('items'));
  }
  
  public function create(ServerRequestInterface $request) {
    $item = $this->getNewEntity();
    
    if ($request->getMethod() === 'POST') {
      $validator = $this->getValidator($request);
      
      if ($validator->isValid()) {
        $this->table->insert($this->prePersist($request, $item));
        $this->postPersist($request, $item);
        $this->flash->success($this->messages['create']);
        
        return $this->redirect($this->routePrefix . '.index');
      }
      
      $errors = $validator->getErrors();
      Hydrator::hydrate($request->getParsedBody(), $item);
    }
    
    return $this->renderer->render(
      $this->viewPath . '/create',
      $this->formParams(compact('item', 'errors'))
    );
  }
  
  public function edit(ServerRequestInterface $request) {
    $id = (int) $request->getAttribute('id');
    $item = $this->table->find($id);
    
    if ($request->getMethod() === 'POST') {
      $validator = $this->getValidator($request);
      
      if ($validator->isValid()) {
        $this->table->update($id, $this->prePersist($request, $item));
        $this->postPersist($request, $item);
        $this->flash->success($this->messages['edit']);
        
        return $this->redirect($this->routePrefix . '.index');
      }
      
      $errors = $validator->getErrors();
      Hydrator::hydrate($request->getParsedBody(), $item);
    }
    
    return $this->renderer->render(
      $this->viewPath . '/edit',
      $this->formParams(compact('item', 'errors'))
    );
  }
  
  public function delete(ServerRequestInterface $request) {
    $this->table->delete($request->getAttribute('id'));
    $this->flash->success($this->messages['delete']);
    
    return $this->redirect($this->routePrefix . '.index');
  }
  
  /**
   * Returns a new entity.
   *
   * @return mixed
   */
  protected function getNewEntity() {
    $entity = $this->table->getEntity();
    
    return new $entity();
  }
  
  protected function getValidator(ServerRequestInterface $request) {
    
    return new Validator($request->getParsedBody());
  }
  
  protected function prePersist(ServerRequestInterface $request, $item): array {
    
    return array_filter($request->getParsedBody(), function ($key) {
      
      return in_array($key, $this->acceptedParams);
    }, ARRAY_FILTER_USE_KEY);
  }
  
  protected function postPersist(ServerRequestInterface $request, $item): void {
  }
  
  protected function formParams(array $params): array {
    
    return $params;
  }
}
