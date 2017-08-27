<?php

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function() use($app) {
  $knowledges = $app['dao.knowledge']->findAll();
  $technologies = $app['dao.technology']->findAll();
  $projects = $app['dao.project']->findAll();
  
  return $app['twig']->render('index.html.twig', [
    'knowledges' => $knowledges,
    'technologies' => $technologies,
    'projects' => $projects
  ]);
});

$app->post('/contact', function(Request $request) use($app) {
  $app['session']->clear();
  $contactRepository = $app['dao.contact'];
  $contact = $contactRepository->validate($request->request->all());
  
  if($contactRepository->hasErrors()) {
    $app['session']->set('errors', $contactRepository->errors());
    
    return $app->redirect('/#contact');
  }
  
  $app['mailer']
    ->from($contact->email(), $contact->name())
    ->send(new Tuxi\Portfolio\Mail\ContactMessage($contact));
  
  if($contactRepository->insert($contact)) {
    $app['session']->getFlashBag()->add('success', "Votre message à bien été envoyé, merci !");
    
    return $app->redirect('/#contact');
  }
  
  
})->bind('contact');
