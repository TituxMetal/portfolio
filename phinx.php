<?php

require_once 'vendor/autoload.php';

try {
  (new Dotenv\Dotenv(__DIR__))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    return;
}

$database = [
  'adapter' => getenv('DB_DRIVER') === 'pdo_mysql' ? 'mysql' : '',
  'host' => getenv('DB_HOST'),
  'name' => getenv('DB_NAME'),
  'user' => getenv('DB_USERNAME'),
  'pass' => getenv('DB_PASSWORD'),
];

return [
  'paths' => [
    'migrations' => 'storage/migrations',
    'seeds' => 'storage/seeds',
  ],
  'environments' => [
    'default_migration_table' => 'migrations',
    'default' => $database,
  ],
];
