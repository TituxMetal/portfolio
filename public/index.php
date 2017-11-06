<?php

use GuzzleHttp\Psr7\ServerRequest;
use Portfolio\Core\App;
use Portfolio\Core\Middlewares\DispatcherMiddleware;
use Portfolio\Core\Middlewares\MethodMiddleware;
use Portfolio\Core\Middlewares\NotFoundMiddleware;
use Portfolio\Core\Middlewares\RouterMiddleware;
use Portfolio\Core\Middlewares\TrailingSlashMiddleware;
use Portfolio\Modules\Admin\AdminModule;
use Portfolio\Modules\Home\HomeModule;
use Portfolio\Modules\Knowledge\KnowledgeModule;
use function Http\Response\send;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = (new App(dirname(__DIR__) . '/app/config.php'))
  ->addModule(AdminModule::class)
  ->addModule(KnowledgeModule::class)
  ->addModule(HomeModule::class)
  ->pipe(TrailingSlashMiddleware::class)
  ->pipe(MethodMiddleware::class)
  ->pipe(RouterMiddleware::class)
  ->pipe(DispatcherMiddleware::class)
  ->pipe(NotFoundMiddleware::class);

if (php_sapi_name() !== 'cli') {
  $response = $app->run(ServerRequest::fromGlobals());
  send($response);
}
