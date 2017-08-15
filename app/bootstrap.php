<?php

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

try {
  (new Dotenv\Dotenv(ROOT))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    return;
}

$config = require ROOT . '/app/config/config.php';

$app = new Silex\Application($config);

$app->register(new Silex\Provider\DoctrineServiceProvider());

require ROOT . '/app/routes.php';
