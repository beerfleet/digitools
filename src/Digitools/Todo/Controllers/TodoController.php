<?php

namespace Digitools\Todo\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Todo\Service\TodoService;

class TodoController extends Controller {
  /* @var $srv TodoService */
  private $srv;  

  public function __construct ($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new TodoService($em, $app);
  }

  public function todo_home() {
    echo("<H1>Work is progress</h1>");
  }

  public function todo_new() {
    $app = $this->getApp();
    $priorities = $this->srv->getPriorities();
    $app->render('Todo/todo_new.html.twig', ['globals' => $this->getGlobals(), 'priorities' => $priorities]);
  }
  
  public function todo_new_store() {
    $app = $this->getApp();
    $this->srv->storeTodo();
    $app->redirect($app->urlFor('todo_new'));
  }
}