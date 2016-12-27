<?php

/*
 * Logbook actions backend
 */

namespace Digitools\Logbook\Service;

use Digitools\Logbook\Entities\Log;
use Digitools\Logbook\Service\Validation\LogbookValidation;
use Digitools\Logbook\Entities\Repo\LogRepo;
use Doctrine\ORM\EntityManager;
use Digitools\EslTools\Entities\User;
use Digitools\Exceptions\LogExistsException;
use Slim\Slim;

/**
 *
 * @author jan
 */
class LogService {

  private $errors;
  private $user;
  /* @var $em EntityManager */
  private $em;
  private $app;

  function __construct($em, $app, $user) {
    $this->errors = null;
    $this->em = $em;
    $this->app = $app;
    $this->user = $user;
  }

  /*
   * If todays log exixts, throw exception
   * #demonstrate #exception #handling #slim
   * 
   * Needs $app->config('debug', false);
   */

  private function check_log_exists() {
    $app = $this->app;
    $app->error(function ( LogExistsException $e) use ($app) {
      $app->flash('error', $e->getMessage());
      $app->redirect($app->urlFor('log_new'));
    });

    // error if todays log is already createg
    $sql = "SELECT * FROM log WHERE DATE(created) = DATE(NOW())";
    $conn = $this->em->getConnection();
    $todays_log = $conn->fetchAll($sql);
    if ($todays_log > 0) {
      throw new LogExistsException();
    }
  }

  public function store_log_entry() {
    // validate       
    /* @var $app Slim */
    $app = $this->app;
    $em = $this->em;
    
    //$this->check_log_exists();

    // is the input valid?
    $val = new LogbookValidation($app, $em);
    if ($val->validate()) {
      /* @var $log Log */
      $log = new Log();
      $log->set_entry($app->request->post('log_entry'));
      $log->set_created(new \DateTime());
      $log->set_user($this->user);
      try { // valid = store
        $em->persist($log);
        $em->flush();
      } catch (Exception $e) {
        echo($e->getMessage());
      }
    } else { // invalid = spout error
      $this->errors = $val->getErrors();
    }
  }

  public function list_log_entries_lifo() {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\Logbook\Entities\Log');

    /* @var $repo LogRepo */
    return $repo->find_ordered_lifo($this->user);
  }

  public function load_entry_data_by_id($id) {

    $repo = $this->em->getRepository('Digitools\Logbook\Entities\Log');
    /* @var $log Log */
    $log = $repo->find($id);

    // check whether the logged on user is the one who wrote this entry
    /* @var $entry_usr_obj User */
    $entry_usr_id = $log->get_user()->getId();
    //$entry_usr_id = $log->get_user()->get_id();
    $logged_on_usr = $this->user->getId();
    return $entry_usr_id == $logged_on_usr ? $log : null;
  }

  public function store_modified_entry($id) {
    $app = $this->app;
    $em = $this->em;
    $val = new LogbookValidation($app, $em);
    if ($val->validate()) {
      /* @var $log Log */
      $repo = $em->getRepository('Digitools\Logbook\Entities\Log');
      $log = $repo->find($id);
      $log->set_entry($app->request->post('log_entry'));
      $entry = $log->get_entry();
      echo $log->get_entry();
      try {
        $em->persist($log);
        $em->flush();
      } catch (Exception $e) {
        echo($e->getMessage());
      }
    } else {
      $this->errors = $val->getErrors();
      var_dump($this->errors);
    }
  }

  public function get_errors() {
    return $this->errors;
  }

}
