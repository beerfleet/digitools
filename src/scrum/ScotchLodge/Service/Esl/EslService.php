<?php

namespace scrum\ScotchLodge\Service\Esl;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Esl;

/**
* EslService
*
* @author Jan Van Biervliet
*/

class EslService {
  private $em;
  private $app;
  private $errors;

  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    $this->errors = null;
  }

  public function getErrors() {
    return $this->errors;
  }
}