<?php

namespace scrum\ScotchLodge\Controllers;

//use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Profile\ProfileService;
use scrum\ScotchLodge\Service\Event\EventService;
use scrum\ScotchLodge\Service\Comment\CommentService;
use scrum\ScotchLodge\Service\Whisky\WhiskyService;
use scrum\ScotchLodge\Controllers\Controller;

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
    $members = $prof_srv->showalluser();    
    
    $this->getApp()->render('homepage.html.twig', ['members' => $members]);
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
