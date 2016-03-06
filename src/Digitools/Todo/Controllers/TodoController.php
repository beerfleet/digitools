<?php

namespace Digitools\Todo\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Todo\Service\TodoService;

class TodoController extends Controller {
  /* @var $srv TodoService */
  private $srv; 
  private $em;
  private $app;

  public function __construct ($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new TodoService($em, $app);
  }

  public function todo_home() {
    echo "WAKKA WAKKA";
  }

}