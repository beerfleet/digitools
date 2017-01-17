<?php

namespace Digitools\eslTools\Controllers;

//use Digitools\eslTools\Controllers\Controller;
use Digitools\EslTools\Service\Profile\ProfileService;
use Digitools\EslTools\Service\Event\EventService;
use Digitools\EslTools\Service\Comment\CommentService;
use Digitools\EslTools\Service\Whisky\WhiskyService;
use Digitools\Common\Controllers\Controller;

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
    $test = $this->isUserLoggedIn();
    
    $app->render('homepage.html.twig', ['globals' => $this->getGlobals()]);
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
