<?php

$app->get('/', function() {
  ob_start();
  require dirname(__DIR__) . '/resources/templates/view.php';
  $view = ob_get_clean();
  
  return $view;
});
