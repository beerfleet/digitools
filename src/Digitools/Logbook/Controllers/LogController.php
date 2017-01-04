<?php

namespace Digitools\Logbook\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Logbook\Service\LogService;
use Digitools\Logbook\Entities\Log;
use Digitools\EslTools\Entities\User;

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
    //$app->config('debug', false);    
  }

  public function new_log_entry() {
    /* @var $app Slim */
    $app = $this->app;
    /* @var $srv LogService */
    $srv = $this->srv;

    if ($this->getUser() != null) {
      $result = $srv->get_logs_and_tags();
      $log_entry_list = $result['logs'];
      $tag_list = $result['tags'];
      $app->render('Logbook/new_log_entry.html.twig', array('globals' => $this->getGlobals(), 'log_list' => $log_entry_list, 'tag_list' => $tag_list));
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
        $app->render($app->urlFor('homepage'));
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
      $entry_tags = $entry->get_tags();

      if ($entry == null) {
        $app->flash('error', 'Ongeldige bewerking.');
        $app->redirect($app->urlFor('main_page'));
      }
      $app->render('Logbook/edit_log_entry.html.twig', ['globals' => $this->getGlobals(),
          'log' => $entry,
          'tag_list' => $srv->list_tags(),
          'entry_tags' => $entry_tags
      ]);
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

  /**
   * Listing of logs filtered by 1 or several tags: entry point
   */
  public function show_logs_filter_by_tags() {
    $app = $this->app;
    $srv = new LogService($this->getEntityManager(), $app, $this->getUser());        
    if (array_key_exists('tags_chk', $app->request->post()) === false) {
      $app->flash('error', 'Filter niet gelukt. Selecteer 1 of meerdere tags.');
      $app->redirect($this->app->urlFor('log_new'));
    }
    $list = $srv->get_filtered_logs_and_tags();
    if (sizeof($list['logs']) < 1) {
      $app->flash('error', 'Geen resultaten gevonden.');
      $app->redirect($this->app->urlFor('log_new'));
    }
    $app->render('Logbook/filter_logs_by_tags.html.twig', array('globals' => $this->getGlobals(), 'log_list' => $list['logs'], 'tag_list' => $list['tags']));
  }

  /**
   * Log Tagging
   */
  public function add_tag_if_new() {
    $tag = $this->app->request->post('tag');
    $srv = new LogService($this->getEntityManager(), $this->app, $this->getUser());
    $srv->add_tag_if_not_exists($tag);
  }

  public function manage_tags() {
    /* @var $user User */
    $user = $this->getUser();
    $admin = $user->isAdmin();
    $app = $this->app;
    if ($admin == 1) {
      $em = $this->getEntityManager();
      $srv = new LogService($em, $app, $user);
      $app->render('Logbook/manage_tags.html.twig', ['globals' => $this->getGlobals(), 'tag_list' => $srv->list_tags()]);
    } else {
      echo "Need admin rights";
    }
  }

  /*
   * VOORBEELD: AJAX, JSON, ASYNC
   * Edit tags live while modifying a log entry
   */
  public function store_tag_status() {
    $app = $this->app;
    $log_id = $app->request->post("log_id");
    $tag_id = $app->request->post("tag_id");
    $srv = new LogService($this->getEntityManager(), $app, $this->getUser());
    $srv->store_new_tag_status($log_id, $tag_id);
  }
  
  /* EXAMPLE: how to pass data to Javascript from PHP through AJAX */
  public function find_tag_by_desc() {
    $tag_desc = $_POST['tag'];
    $srv = new LogService($this->getEntityManager(), $this->app, $this->getUser());    
    $tag = $srv->find_tag_by_description($tag_desc);        
    $json_tag = json_encode( ['id' => $tag['id']] );
    echo $json_tag;
  }
  
  public function delete_tags() {    
    $app = $this->getApp();
    $srv = new LogService($this->getEntityManager(), $app, $this->getUser());
    $srv->delete_tags();
    echo json_encode(['deleted' => 1]);
  }

}
