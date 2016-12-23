<?php

namespace Digitools\Logbook\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Logbook\Service\LogService;
use Digitools\Logbook\Entities\Log;
use Exception;

/**
 * @author jan
 */
class LogController extends Controller {
  /* @var $srv LogService */

  private $srv;
  private $em;
  private $app;
  /* @var $log Log */
  private $log;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new LogService($em, $app, $this->getUser());
    $this->em = $em;
  }

  public function show_log_form() {
    $this->srv->insert_log(new Log());    
    
  }

}
