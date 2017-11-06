<?php

namespace Tests\Core\Actions;

use GuzzleHttp\Psr7\ServerRequest;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use PHPUnit\Framework\TestCase;
use Portfolio\Core\Actions\CrudActions;
use Portfolio\Core\Database\Query;
use Portfolio\Core\Database\Table;
use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\FlashService;
use Portfolio\Core\Templating\RendererInterface;
use ReflectionClass;
use stdClass;

/**
 * Description of CrudActionsTest
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class CrudActionsTest extends TestCase {
  
  /**
   *
   * @var FlashService
   */
  private $flash;
  
  /**
   * @var Table
   */
  private $table;
  
  public function setUp() {
    $this->table = $this->getMockBuilder(Table::class)->disableOriginalConstructor()->getMock();
    $this->query = $this->getMockBuilder(Query::class)->getMock();
    
    $this->table->method('getEntity')->willReturn(stdClass::class);
    $this->table->method('findPaginated')->willReturn($this->query);
    $this->table->method('find')->willReturnCallback(function ($id) {
      $object = new stdClass();
      $object->id = (int) $id;
      
      return $object;
    });
    $this->flash = $this->getMockBuilder(FlashService::class)->disableOriginalConstructor()->getMock();
    $this->renderer = $this->getMockBuilder(RendererInterface::class)->getMock();
  }
  
  public function makeCrudActions() {
    $this->renderer->method('render')->willReturn('');
    
    $router = $this->getMockBuilder(Router::class)->getMock();
    $router->method('generateUri')->willReturnCallback(function ($uri) {
      return $uri;
    });
    
    $action = new CrudActions($this->renderer, $router, $this->table, $this->flash);
    
    $property = (new ReflectionClass($action))->getProperty('viewPath');
    $property->setAccessible(true);
    $property->setValue($action, '@demo');
    $prop = (new ReflectionClass($action))->getProperty('acceptedParams');
    $prop->setAccessible(true);
    $prop->setValue($action, ['title']);
    
    return $action;
  }
  
  public function testIndex() {
    $request = new ServerRequest('GET', '/test');
    $pager = new Pagerfanta(new ArrayAdapter([1, 2]));
    $this->renderer
      ->expects($this->once())
      ->method('render')
      ->with(
        '@demo/index',
        $this->callback(function () use ($pager) {
          $this->assertInstanceOf(Pagerfanta::class, $pager);
          
          return true;
        })
    );
    
    call_user_func($this->makeCrudActions(), $request);
  }
  
  public function testCreate() {
    $request = (new ServerRequest('GET', '/new'));
    $this->renderer
      ->expects($this->once())
      ->method('render')
      ->with(
        '@demo/create',
        $this->callback(function ($params) {
          $this->assertInstanceOf(stdClass::class, $params['item']);
          
          return true;
        })
      );

    call_user_func($this->makeCrudActions(), $request);
  }
  
  public function testCreateWithParams() {
    $request = (new ServerRequest('POST', '/new'))
      ->withParsedBody(['title' => 'demo']);
    $this->table
      ->expects($this->once())
      ->method('insert')
      ->with(['title' => 'demo']);
    
    $response = call_user_func($this->makeCrudActions(), $request);
    
    $this->assertEquals(['.index'], $response->getHeader('Location'));
  }
  
  public function testEdit() {
    $id = 1337;
    $request = (new ServerRequest('GET', '/test'))->withAttribute('id', $id);
    $this->renderer
      ->expects($this->once())
      ->method('render')
      ->with(
        '@demo/edit',
        $this->callback(function ($params) use ($id) {
          $this->assertAttributeEquals($id, 'id', $params['item']);
          
          return true;
        })
      );

    call_user_func($this->makeCrudActions(), $request);
  }
  
  public function testEditWithParams() {
    $id = 1337;
    $request = (new ServerRequest('POST', '/test'))
      ->withAttribute('id', $id)
      ->withParsedBody(['title' => 'demo']);
    $this->table
      ->expects($this->once())
      ->method('update')
      ->with($id, ['title' => 'demo']);
    
    $response = call_user_func($this->makeCrudActions(), $request);
    
    $this->assertEquals(['.index'], $response->getHeader('Location'));
  }
  
  public function testDelete() {
    $id = 1337;
    $request = (new ServerRequest('DELETE', '/test'))
      ->withAttribute('id', $id);
    $this->table
      ->expects($this->once())
      ->method('delete')
      ->with($id);
    
    $response = call_user_func($this->makeCrudActions(), $request);
    
    $this->assertEquals(['.index'], $response->getHeader('Location'));
  }
}
