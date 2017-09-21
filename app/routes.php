<?php

// The homepage route
$app->get('/', "Tuxi\Portfolio\Controllers\HomeController::home")
  ->bind('home');

// The post route for contact form
$app->post('/contact', "Tuxi\Portfolio\Controllers\HomeController::contact")
  ->bind('contact');
