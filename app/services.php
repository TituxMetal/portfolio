<?php

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Tuxi\Portfolio\Repository\{
  KnowledgeRepository,
  TechnologyRepository,
  ProjectRepository
};

/*
 * Add the Doctrine service provider for database connection.
 */
$app->register(new DoctrineServiceProvider());

/**
 * Add the Twig service provider
 */
$app->register(new TwigServiceProvider(), [
  'twig.path' => dirname(__DIR__) . '/resources/templates'
]);

/*
 * Add the Knowledge repository.
 */
$app['dao.knowledge'] = function($app) {
  
  return new KnowledgeRepository($app['db']);
};

/*
 * Add the Technology repository.
 */
$app['dao.technology'] = function($app) {
  
  return new TechnologyRepository($app['db']);
};

/*
 * Add the Project repository.
 */
$app['dao.project'] = function($app) {
  
  return new ProjectRepository($app['db']);
};
