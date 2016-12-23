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
  include 'config/routes/todo.php';
  include 'config/routes/log.php';
  
  $app->run();
    
} catch (Exception $ex) {
  $app->render('probleem.html.twig', array('probleem' => $ex->getMessage()));
}