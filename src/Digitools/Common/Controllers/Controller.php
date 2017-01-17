<?php

namespace Digitools\Common\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;

/**
 * Controller abstract controller
 *
 * @author jan van biervliet
 */
abstract class Controller {
  /* @var $em EntityManager */

  private $em;

  /* @var $app  Slim */
  private $app;

  function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function getEntityManager() {
    return $this->em;
  }

  public function getApp() {
    return $this->app;
  }

  /**
   * Gets Slim $app, current user and session vars for use in Twig 
   * @return 1 dimensional array of global vars
   */
  public function getGlobals() {
    $globals = array(
        'app' => $this->app, // http://docs.slimframework.com/
        'user' => $this->getUser(), // User
        'logged_in' => $this->isUserLoggedIn(), // is user logged in ?
        'session' => $this->getSession(), // session var array
        'path' => $_SERVER['REQUEST_URI'], // current path,      
        'root' => 'http://' . $_SERVER['HTTP_HOST']
    );
    return $globals;
  }

  public function getSession() {
    return $_SESSION;
  }

  private function queryUserByUserName($username) {
    $em = $this->getEntityManager();
    $repo = $em->getRepository('Digitools\EslTools\Entities\User');
    $user = $repo->findBy(array('username' => $username));
    return $user[0];
  }

  public function getUser() {
    if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
      $user = $this->queryUserByUserName($_SESSION['user']);
    }
    return isset($user) ? $user : null;
  }

  public function isUserAnonymous() {
    return !$this->isLoggedIn();
  }

  public function isUserLoggedIn() {
    return $this->getUser() !== null;
  }

  public function isUserAdmin() {
    if (isset($_SESSION['user'])) {
      $username = $_SESSION['user'];
      $user = $this->queryUserByUserName($username);
      return $user->isAdmin() == 1 ? true : false;
    }
    return false;
  }

}
