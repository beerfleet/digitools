<?php

use Doctrine\Common\ClassLoader;

include 'bootstrap.php';

$classloader = new ClassLoader("scrum", "src");
$classloader->register();

try {
  /* routes */  
  include 'config/routes/register.php';
  include 'config/routes/profile.php';
  include 'config/routes/main.php';
  include 'config/routes/event.php';
  include 'config/routes/members.php';
  include 'config/routes/whisky.php';
  include 'config/routes/whiskylike.php';
  include 'config/routes/commentlike.php';
  include 'config/routes/category.php';
  
  $app->run();
    
} catch (Exception $ex) {
  $app->render('probleem.html.twig', array('probleem' => $ex->getMessage()));
}