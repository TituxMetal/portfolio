<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

require dirname(__DIR__) . '/app/routes.php';

$app->run();
