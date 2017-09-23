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
  'mail' => [
    'host' => getenv('MAIL_HOST'),
    'port' => getenv('MAIL_PORT'),
    'username' => getenv('MAIL_USERNAME'),
    'password' => getenv('MAIL_PASSWORD'),
    'auth_mode' => getenv('MAIL_AUTH'),
    'encryption' => getenv('MAIL_ENC'),
    'from' => [
      'address' => getenv('MAIL_FROM_ADDRESS'),
      'name' => getenv('MAIL_FROM_NAME')
    ],
  ],
  'debug' => getenv('APP_DEBUG')
];
