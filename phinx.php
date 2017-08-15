<?php

require 'app/bootstrap.php';

return [
  'paths' => [
    'migrations' => 'storage/migrations',
  ],
  'environments' => [
    'default_migration_table' => 'migrations',
    'default' => [
      'adapter' => getenv('DB_DRIVER'),
      'host' => getenv('DB_HOST'),
      'name' => getenv('DB_NAME'),
      'user' => getenv('DB_USERNAME'),
      'pass' => getenv('DB_PASSWORD'),
    ],
  ],
];
