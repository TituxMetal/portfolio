<?php

use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\PhpSession;
use Portfolio\Core\Sessions\SessionInterface;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Core\Templating\TwigRendererFactory;
use Portfolio\Core\TwigExtensions\FormExtension;
use Portfolio\Core\TwigExtensions\PagerfantaExtension;
use Portfolio\Core\TwigExtensions\RouterTwigExtension;
use Psr\Container\ContainerInterface;
use function DI\factory;
use function DI\get;
use function DI\object;

return [
  'database.host' => 'localhost',
  'database.username' => 'tuxi',
  'database.password' => '',
  'database.name' => 'portfolioTest',
  'migrations.path' => dirname(__DIR__) . '/storage/migrations',
  'seeds.path' => dirname(__DIR__) . '/storage/seeds',
  'views.path' => dirname(__DIR__) . '/resources/templates',
  'twig.extensions' => [
    get(PagerfantaExtension::class),
    get(FormExtension::class),
    get(RouterTwigExtension::class)
  ],
  \PDO::class => function (ContainerInterface $container) {
    return new \PDO(
      "mysql:host={$container->get('database.host')};dbname={$container->get('database.name')}",
      $container->get('database.username'),
      $container->get('database.password'),
      [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
      ]
    );
  },
  RendererInterface::class => factory(TwigRendererFactory::class),
  Router::class => object(),
  SessionInterface::class => object(PhpSession::class)
];
