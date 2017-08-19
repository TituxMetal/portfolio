<?php

$app->get('/', function() use($app) {
  $knowledges = $app['dao.knowledge']->findAll();
  $technologies = $app['dao.technology']->findAll();
  
  return $app['twig']->render('index.html.twig',
    ['knowledges' => $knowledges, 'technologies' => $technologies]
  );
});
