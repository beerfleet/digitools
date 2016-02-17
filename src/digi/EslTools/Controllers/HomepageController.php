<?php

namespace digi\eslTools\Controllers;

//use digi\eslTools\Controllers\Controller;
use digi\eslTools\Service\Profile\ProfileService;
use digi\eslTools\Service\Event\EventService;
use digi\eslTools\Service\Comment\CommentService;
use digi\eslTools\Service\Whisky\WhiskyService;
use digi\eslTools\Controllers\Controller;

/**
 * HomepageController
 *
 * @author jan van biervliet
 */
class HomepageController extends Controller {

  public function homepage() {
    $em = $this->getEntityManager();
    $app = $this->getApp();
    
    $globals = $this->getGlobals();

    $prof_srv = new ProfileService($em, $app);
    $members = $prof_srv->showAllUsers();
    
    $app->render('homepage.html.twig', ['globals' => $this->getGlobals(), 'members' => $members]);
  }

  public function simplifydRoutes($routes) {
    $simple = array();
    foreach ($routes as $route) {
      $simple[$route->getName()] = $route->getPattern();
    }
    return $simple;
  }

  public function showRoutes() {
    $app = $this->getApp();
    $routes = $app->router->getNamedRoutes();
    $simple = $this->simplifydRoutes($routes);
    $app->render('Test\routes.html.twig', array('globals' => $this->getGlobals(), 'routes' => $simple));
  }
  
  public function notFound() {
    $app = $this->getApp();
    $app->render('Error\error_404.html.twig', array('error' => 'Page not found'));
  }

}
