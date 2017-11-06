<?php

require __DIR__ . '/public/index.php';

$migrations[] = $app->getContainer()->has('migrations.path') ? $app->getContainer()->get('migrations.path') : '';
$seeds[] = $app->getContainer()->has('seeds.path') ? $app->getContainer()->get('seeds.path') : '';

foreach ($app->getModules() as $module) {
  if ($module::MIGRATIONS) {
    $migrations[] = $module::MIGRATIONS;
  }
  
  if ($module::SEEDS) {
    $seeds[] = $module::SEEDS;
  }
}

return [
  'paths' => [
    'migrations' => $migrations,
    'seeds' => $seeds
  ],
  'environments' => [
    'default_database' => 'development',
    'development' => [
      'adapter' => 'mysql',
      'host' => $app->getContainer()->get('database.host'),
      'name' => $app->getContainer()->get('database.name'),
      'user' => $app->getContainer()->get('database.username'),
      'pass' => $app->getContainer()->get('database.password')
    ]
  ]
];
