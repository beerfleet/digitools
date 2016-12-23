<?php

/*
 * Logbook actions backend
 */

namespace Digitools\Logbook\Service;

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

  public function insert_log($log) {
    $log->set_user($this->user);
    $log->set_entry("This is starlog Alfa Draco Tango");
    $log->set_created(new \DateTime());
    $em = $this->em;
    try {
      $em->persist($log);
      $em->flush();
      echo("Persisted OK");
    } catch (Exception $e) {
      echo($e->getMessage());
    }
  }

}
