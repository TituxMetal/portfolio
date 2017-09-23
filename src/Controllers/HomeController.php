<?php

namespace Tuxi\Portfolio\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Tuxi\Portfolio\Mail\ContactMessage;

class HomeController {
  
  public function home(Application $app) {
    $knowledges = $app['dao.knowledge']->findAll();
    $technologies = $app['dao.technology']->findAll();
    $projects = $app['dao.project']->findAll();

    return $app['twig']->render('index.html.twig', [
      'knowledges' => $knowledges,
      'technologies' => $technologies,
      'projects' => $projects
    ]);
  }
  
  public function contact(Application $app, Request $request) {
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
      ->send(new ContactMessage($contact));

    if($contactRepository->insert($contact)) {
      $app['session']->getFlashBag()->add(
        'success',
        "Votre message a bien été envoyé, merci !"
      );

      return $app->redirect('/#contact');
    }
  }
  
}
