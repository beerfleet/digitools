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
    /* @var $app Slim */
    $app = $this->app;
    /* @var $srv LogService */
    $srv = $this->srv;

    if ($this->getUser() != null) {
      $log_entry_list = $srv->list_log_entries_lifo();
      $app->render('Logbook/new_log_entry.html.twig', array('globals' => $this->getGlobals(), 'log_list' => $log_entry_list));
    } else {
      $app->flash('info', 'Gebruiker dient aangemeld te zijn om logboek te bekijken.');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  public function process_new_entry() {
    try {
      $app = $this->getApp();
      $this->srv->store_log_entry();
      $errors = $this->srv->get_errors();

      if ($this->getUser()) {
        if (!$errors) {          
          $app->flash('info', 'De entry werd opgeslagen.');
          $app->redirect($app->urlFor('new_log_entry'));
        } else {
          $errors = $this->srv->get_errors();
          //$app->render('Logbook/new_log_entry.html.twig', array('globals' => $this->getGlobals(), 'errors' => $errors));
          $app->flash('error', 'Lege entries worden niet opgeslagen.');
          $app->redirect($app->urlFor('new_log_entry'));
        }
      } else {
        $app->flash('error', 'Er is geen gebruiker aangemeld.');
        $app->render($app->getUrl('homepage'));
      }
    } catch (Exception $e) {
      $this->getApp()->render('probleem.html.twig');
    }
  }

}
