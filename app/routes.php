<?php

$app->get('/', function() use($app) {
  $knowledges = $app['dao.knowledge']->findAll();
  
  return $app['twig']->render('index.html.twig', ['knowledges' => $knowledges]);
});
