<?php

use Silex\Provider\DoctrineServiceProvider;
use Tuxi\Portfolio\Repository\KnowledgeRepository;

/*
 * Add the Doctrine service provider for database connection.
 */
$app->register(new DoctrineServiceProvider());

/*
 * Add the Knowledge repository.
 */
$app['dao.knowledge'] = function($app) {
  
  return new KnowledgeRepository($app['db']);
};
