<?php

namespace Digitools\Logbook\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Logbook\Service\LogService;

/**
 * @author jan
 */
class LogController extends Controller {

  /* @var $srv LogbookSrv */
  private $srv;
  private $em;
  private $app;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new EslService($em, $app);
  }
  
  public function testMakeLog() {
    echo("TEST MAKE LOG");
  }

}
