<?php

namespace scrum\ScotchLodge\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Controllers\Controller;

/**
* ESLController Controller
* @author Jan Van Biervliet
*/

class EslController extends Controller {
  
  private $eslService; 
  private $em;
  private $app;

  private function __construct ($em, $app) {
    parent::construct($em, $app);
    $this->eslService = new EslService($em, $app);
  }
}