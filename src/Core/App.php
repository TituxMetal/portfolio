<?php

namespace Portfolio\Core;

use DI\ContainerBuilder;
use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Description of App
 *
 * @author Titux Metal <tituxmetal@gmail.com>
 */
class App implements DelegateInterface {

  /**
   * @var ContainerInterface
   */
  private $container;

  /**
   * @var string|array|null
   */
  private $definition;
  
  /**
   * @var int
   */
  private $index = 0;
  
  /**
   * @var string[]
   */
  private $middlewares = [];

  /**
   * List of modules
   * @var array
   */
  private $modules = [];
  
  /**
   * @param string|null $definition
   */
  public function __construct($definition = null) {
    $this->definition = $definition;
  }
  
  /**
   * Add a module to the app
   * 
   * @param string $module
   * @return \Portfolio\Core\App
   */
  public function addModule(string $module): self {
    $this->modules[] = $module;
    
    return $this;
  }
  
  /**
   * Add a middleware to the app
   * 
   * @param string|null $middleware
   * @return \Portfolio\Core\App
   */
  public function pipe($middleware = null): self {
    
    if (!is_null($middleware)) {
      $this->middlewares[] = $middleware;
    }
    
    return $this;
  }
  
  public function process(ServerRequestInterface $request): ResponseInterface {
    $middleware = $this->getMiddleware();
    
    if (is_null($middleware)) {
      throw new Exception('No middleware');
    }
      
    if (is_callable($middleware)) {

      return call_user_func_array($middleware, [$request, [$this, 'process']]);
    }

    if ($middleware instanceof MiddlewareInterface) {

      return $middleware->process($request, $this);
    }
  }
  
  public function run(ServerRequestInterface $request): ResponseInterface {
    
    foreach ($this->modules as $module) {
      $this->getContainer()->get($module);
    }
    
    return $this->process($request);
  }
  
  public function getModule(): array {
    
    return $this->modules;
  }
  
  public function getContainer(): ContainerInterface {
    
    if (is_null($this->container)) {
      
      return $this->buildContainer();
    }
    
    return $this->container;
  }
  
  /**
   * @return object|null
   */
  private function getMiddleware() {
    
    if (array_key_exists($this->index, $this->middlewares)) {
      
      if (is_string($this->middlewares[$this->index])) {
        $middleware = $this->container->get($this->middlewares[$this->index]);
      } else {
        $middleware = $this->middlewares[$this->index];
      }
      
      $this->index++;
      
      return $middleware;
    }
    
    return null;
  }
  
  private function buildContainer(): ContainerInterface {
    $builder = new ContainerBuilder();
      
    if ($this->definition) {
      $builder->addDefinitions($this->definition);
    }

    if ($this->modules) {
      array_map(function ($module) use ($builder) {

        ($module::DEFINITIONS) ? $builder->addDefinitions($module::DEFINITIONS) : '';
      }, $this->modules);
    }

    $this->container = $builder->build();

    return $this->container;
  }
  
}
