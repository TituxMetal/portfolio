<?php

return [
  'db.options' => [
    'driver' => getenv('DB_DRIVER'),
    'charset' => 'utf8',
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT'),
    'dbname' => getenv('DB_NAME'),
    'user' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
  ],
  'debug' => getenv('APP_DEBUG')
];
