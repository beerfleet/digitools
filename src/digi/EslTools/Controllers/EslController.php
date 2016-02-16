<?php

namespace digi\eslTools\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use digi\eslTools\Controllers\Controller;
use digi\eslTools\Service\Esl\EslService;


/**
* ESLController Controller
* @author Jan Van Biervliet
*/

class EslController extends Controller {
  
  private $eslService; 
  private $em;
  private $app;

  public function __construct ($em, $app) {
    parent::__construct($em, $app);
    $this->eslService = new EslService($em, $app);
  }

  public function esl_home() {
    
  }
}