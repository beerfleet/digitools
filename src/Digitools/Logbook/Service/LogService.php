<?php

/*
 * Logbook actions backend
 */

namespace Digitools\Logbook\Service;

use Digitools\Logbook\Entities\Log;
use Digitools\Logbook\Service\Validation\LogbookValidation;
use Digitools\Logbook\Entities\Repo\LogRepo;

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
    if ($val->validate()) {
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
    } else {
      $this->errors = $val->getErrors();
    }
  }

  public function list_log_entries_lifo() {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\Logbook\Entities\Log');

    /* @var $repo LogRepo */
    return $repo->find_ordered_lifo($this->user);
  }

  public function get_errors() {
    return $this->errors;
  }

}
