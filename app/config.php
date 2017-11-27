<?php

use Portfolio\Core\Routing\Router;
use Portfolio\Core\Sessions\PhpSession;
use Portfolio\Core\Sessions\SessionInterface;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Core\Templating\TwigRendererFactory;
use Portfolio\Core\TwigExtensions\FlashExtension;
use Portfolio\Core\TwigExtensions\FormExtension;
use Portfolio\Core\TwigExtensions\PagerfantaExtension;
use Portfolio\Core\TwigExtensions\RouterTwigExtension;
use Psr\Container\ContainerInterface;
use function DI\env;
use function DI\factory;
use function DI\get;
use function DI\object;

return [
  'env' => env('ENV', 'prod'),
  'database.host' => env('DB_HOST', 'localhost'),
  'database.username' => env('DB_USER', 'root'),
  'database.password' => env('DB_PASS', 'root'),
  'database.name' => env('DB_NAME', 'database'),
  'mail.to' => env('MAIL_TO', 'admin@local.dev'),
  'mail.host' => env('MAIL_HOST', 'localhost'),
  'mail.port' => env('MAIL_PORT', 1025),
  'mail.username' => env('MAIL_USER', null),
  'mail.password' => env('MAIL_PASS', null),
  'mail.auth' => env('MAIL_AUTH', null),
  'mail.encryption' => env('MAIL_ENC', null),
  'migrations.path' => dirname(__DIR__) . '/storage/migrations',
  'seeds.path' => dirname(__DIR__) . '/storage/seeds',
  'views.path' => dirname(__DIR__) . '/resources/templates',
  'twig.extensions' => [
    get(PagerfantaExtension::class),
    get(FormExtension::class),
    get(FlashExtension::class),
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
