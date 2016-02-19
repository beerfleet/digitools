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
    $this->getApp()->render('Esl/esl_main_page.html.twig', ['globals' => $this->getGlobals()]);
  }

  public function esl_sheet_show() {
    echo "SHOW CLIENTS";
  }

  public function esl_sheet_new() {
  $app = $this->getApp();
    if ($this->isUserLoggedIn()) {
      $app->render('Esl/esl_new_client.html.twig', ['globals' => $this->getGlobals()]);
    } else {
      $app->flash('error', 'U moet aangemeld zijn om een klant aan te maken.');
      $app->redirect($app->urlFor('main_page'));
    }
  }
}