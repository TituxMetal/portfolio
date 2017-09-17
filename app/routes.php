<?php

use Symfony\Component\HttpFoundation\Request;

// The homepage route
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

// The post route for contact form
$app->post('/contact', function(Request $request) use($app) {
  $contactRepository = $app['dao.contact'];
  $contact = $contactRepository->validate($request->request->all());
  
  if($contactRepository->hasErrors()) {
    $app['session']->getFlashBag()->add(
      'errors',
      $contactRepository->errors()
    );
    
    return $app->redirect('/#contact');
  }
  
  $app['mailer']
    ->from($contact->email(), $contact->name())
    ->send(new Tuxi\Portfolio\Mail\ContactMessage($contact));
  
  if($contactRepository->insert($contact)) {
    $app['session']->getFlashBag()->add(
      'success',
      "Votre message a bien été envoyé, merci !"
    );
    
    return $app->redirect('/#contact');
  }
  
  
})->bind('contact');
