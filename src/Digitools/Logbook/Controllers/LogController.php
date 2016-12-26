<?php

namespace Digitools\Logbook\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Logbook\Service\LogService;
use Digitools\Logbook\Entities\Log;

/**
 * @author jan
 */
class LogController extends Controller {
  /* @var $srv LogService */

  private $srv;
  private $em;
  private $app;
  /* @var $log Log */
  private $log;

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
      // Execute only when user is logged on
      if ($this->getUser()) {
        if (!$errors) {
          $app->flash('info', 'De entry werd opgeslagen.');
          $app->redirect($app->urlFor('log_new'));
        } else {
          $app->flash('error', 'Lege entries worden niet opgeslagen.');
          $app->redirect($app->urlFor('log_new'));
        }
      } else {
        $app->flash('error', 'Er is geen gebruiker aangemeld.');
        $app->render($app->getUrl('homepage'));
      }
    } catch (Exception $e) {
      $this->getApp()->render('probleem.html.twig');
    }

    $this->em = $em;
  }

  public function show_log_form() {
    $this->srv->insert_log(new Log());    
    
  }

  public function edit_entry($id) {
    /* @var $app Slim */
    $app = $this->getApp();
    $srv = new LogService($this->getEntityManager(), $app, $this->getUser());

    if ($this->getUser()) {
      /* @var $entry Log */
      $entry = $srv->load_entry_data_by_id($id);
      if ($entry == null) {
        $app->flash('error', 'Ongeldige bewerking.');
        $app->redirect($app->urlFor('main_page'));
      }
      $app->render('Logbook/edit_log_entry.html.twig', ['globals' => $this->getGlobals(), 'log' => $entry]);
    } else {
      $app->flash('error', 'Er is geen gebruiker aangemeld.');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  public function process_modified_entry($id) {
    $app = $this->getApp();
    $srv = new LogService($this->getEntityManager(), $app, $this->getUser());
    // Execute only when user is logged on
    if ($this->getUser()) {
      $srv->store_modified_entry($id);
      $errors = $srv->get_errors();
      if (!$errors) {
        $app->flash('info', 'De wijziging is opgeslagen.');
        $app->redirect($app->urlFor('log_new'));
      } else {
        $app->flash('error', 'Lege entries worden niet opgeslagen.');
        $app->redirect($app->urlFor('log_new'));
      }
    } else {
      $app->flash('error', 'Er is geen gebruiker aangemeld.');
      $app->redirect($app->urlFor('main_page'));
    }
  }

}
