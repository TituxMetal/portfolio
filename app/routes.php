<?php

$app->get('/', function() use($app) {
  $knowledges = $app['dao.knowledge']->findAll();
  
  ob_start();
  require dirname(__DIR__) . '/resources/templates/view.php';
  $view = ob_get_clean();
  
  return $view;
});
