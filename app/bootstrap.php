<?php

define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

try {
  (new Dotenv\Dotenv(ROOT))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    return;
}

$config = require ROOT . '/app/config/config.php';

Symfony\Component\Debug\ErrorHandler::register();
Symfony\Component\Debug\ExceptionHandler::register();

$app = new Silex\Application($config);

require ROOT . '/app/services.php';
require ROOT . '/app/routes.php';
