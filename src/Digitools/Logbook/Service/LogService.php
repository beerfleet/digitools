<?php

/*
 * Logbook actions backend
 */

namespace Digitools\Logbook\Service;

use Digitools\Logbook\Entities\Log;
use Digitools\Logbook\Service\Validation\LogbookValidation;

/**
 *
 * @author jan
 */
class LogService {
  
  private $errors;
  private $user;
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
    $val = new LogbookValidation($app, $em);
    if (!$val->validate()) {
      $this->errors = $val->getErrors();
    }
    
    /* @var $log Log */
    $log = new Log();
    $log->set_entry($app->request->post('log_entry'));    
    $log->set_created(new \DateTime());
    $log->set_user($this->user);
    try {
      $em->persist($log);
      $em->flush();      
    } catch (Exception $e) {
      echo($e->getMessage());
    }
  }
  
  public function get_errors() {
    return $this->errors;
  }

}
