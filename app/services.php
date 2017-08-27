<?php

use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Tuxi\Portfolio\Repository\{
  KnowledgeRepository,
  TechnologyRepository,
  ProjectRepository,
  ContactRepository
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

$app->register(new Silex\Provider\SessionServiceProvider());

$app['mailer'] = function($app) {
  $config = $app['mail'];
  
  $transport = (new Swift_SmtpTransport($config['host'], $config['port']))
    ->setUsername($config['username'])
    ->setPassword($config['password'])
    ->setAuthMode($config['auth_mode'])
    ->setEncryption($config['encryption']);
  
  $swift = new Swift_Mailer($transport);
  
  return (new \Tuxi\Portfolio\Mail\Mailer\Mailer($swift, $app['twig']))
    ->alwaysTo($config['from']['address'], $config['from']['name']);
};

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

/*
 * Add the Contact repository.
 */
$app['dao.contact'] = function($app) {
  
  return new ContactRepository($app['db']);
};
