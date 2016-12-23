<?php

namespace Digitools\Logbook\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Logbook\Service\LogService;

/**
 * @author jan
 */
class LogController extends Controller {
  /* @var $srv LogbookSrv */

  private $srv;
  private $em;
  private $app;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new LogService($em, $app, $this->getUser());
    $this->app = $app;
  }

  public function new_log_entry() {
    $app = $this->app;
    $srv = $this->srv;
    $app->render('Logbook/new_log_entry.html.twig', array('globals' => $this->getGlobals()));
  }

  public function process_new_entry() {
    try {
      $app = $this->getApp();
      $user = $this->srv->store_log_entry();
      if ($user){
        $app->render('Logbook/new_log_entry.html.twig', array('info' ));
      } else {
        $errors = $this->srv->get_errors();
        $app->render('Logbook/new_log_entry.html.twig', array('globals' => $this->getGlobals(), 'errors' => $errors));
      }
    } catch (Exception $e) {
      $this->getApp()->render('probleem.html.twig');
    }
  }

}
