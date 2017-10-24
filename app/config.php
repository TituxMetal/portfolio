<?php

use Portfolio\Core\Routing\Router;
use Portfolio\Core\Templating\RendererInterface;
use Portfolio\Core\Templating\TwigRendererFactory;
use Portfolio\Core\TwigExtensions\RouterTwigExtension;
use function DI\factory;
use function DI\get;
use function DI\object;

return [
  'views.path' => dirname(__DIR__) . '/resources/templates',
  'twig.extensions' => [
    get(RouterTwigExtension::class)
  ],
  RendererInterface::class => factory(TwigRendererFactory::class),
  Router::class => object()
];
