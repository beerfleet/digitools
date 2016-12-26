<?php

/*
 * Logbook actions backend
 */

namespace Digitools\Logbook\Service;

use Digitools\Logbook\Entities\Log;
use Digitools\Logbook\Service\Validation\LogbookValidation;
use Digitools\Logbook\Entities\Repo\LogRepo;
use Doctrine\ORM\EntityManager;

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

  public function store_log_entry() {
    // validate           
    $app = $this->app;
    $em = $this->em;
    
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
    return $repo->find($id);
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
