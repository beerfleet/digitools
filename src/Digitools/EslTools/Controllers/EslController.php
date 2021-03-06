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

  /* @var $srv EslService */
  private $srv; 
  private $em;
  private $app;

  public function __construct ($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new EslService($em, $app);
  }

  public function esl_home() {
    $this->getApp()->render('Esl/esl_main_page.html.twig', ['globals' => $this->getGlobals()]);
  }

  public function esl_sheet_show_all() {    
    $this->getApp()->render('Esl/esl_show_clients.html.twig', ['globals' => $this->getGlobals(), 'stores' => $this->srv->getStores()]);
  }

  public function esl_sheet_new() {
    $app = $this->getApp();
    if ($this->isUserLoggedIn()) {
      $data = $this->srv->getForeignTablesData();      
      $app->render('Esl/esl_new_client.html.twig', ['globals' => $this->getGlobals(), 'data' => $data]);
    } else {
      $app->flash('error', 'U moet aangemeld zijn om een klant aan te maken.');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  public function esl_sheet_new_store() {
    $app = $this->getApp();    
    if ($this->srv->storeEslClient()) {
      $app->redirect($app->urlFor('esl_sheet_new_store'));
    } else {
      $app->render('Esl\esl_new_client.html.twig', ['globals' => $this->getGlobals(), 'errors' => $this->srv->getErrors(), 'data' => $this->srv->getForeignTablesData()]);
    }
  }
  
  public function esl_sheet_show_store($id) {    
    $app = $this->getApp();
    $store = $this->srv->getStoreById($id);
    $app->render('Esl\esl_show_client.html.twig', ['globals' => $this->getGlobals(), 'store' => $store]);
  }
}