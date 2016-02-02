<?php

namespace scrum\ScotchLodge\Service\Validation;

use Doctrine\ORM\EntityManager;
use Valitron\Validator;

/**
 * @author jan van biervliet
 */
abstract class Validation {
  
  /* @var $val Slim() */
  private $app;  
  /* @var $val Validator */
  private $val;
  /* @var $em EntityManager */
  private $em;

  public function __construct($app, $em) {
    $this->val = new Validator($app->request->post());
    $this->em = $em;
    $this->app = $app;
    $this->addRules();
  }

  public function validate() {
    return $this->val->validate();
  }

  function getErrors() {
    $errors = $this->val->errors();
    $err = array();
    foreach ($errors as $errorGroup) {
      foreach ($errorGroup as $error) {
        $err[] = $error;
      }
    }
    return $err;
  }

  function getVal() {
    return $this->val;
  }

  function getEm() {
    return $this->em;
  }
  
  function getApp() {
    return $this->app;
  }

  abstract function addRules();
}
