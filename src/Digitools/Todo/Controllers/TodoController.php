<?php

namespace Digitools\Todo\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Common\Controllers\Controller;
use Digitools\Todo\Service\TodoService;

class TodoController extends Controller {
  /* @var $srv TodoService */

  private $srv;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new TodoService($em, $app);
  }

  public function todo_home() {
    $app = $this->getApp();
    if ($this->getUser()) {
      $app->render('Todo/todo_show_all_from_user.html.twig', 
              ['globals' => $this->getGlobals(), 'items' => $this->srv->getTodosFromUser()]);
    } else {
      $app->flash('error', 'Aanmelding vereist.');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  public function todo_new() {
    $app = $this->getApp();
    if ($this->isUserLoggedIn()) {
      $priorities = $this->srv->getPriorities();
      $app->render('Todo/todo_new.html.twig', ['globals' => $this->getGlobals(),
          'priorities' => $priorities]);
    } else {
      $app->flash('error', 'Sign up or log in to add a todo item');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  public function todo_new_store() {
    $app = $this->getApp();
    $this->srv->storeTodo();
    $app->redirect($app->urlFor('todo_new'));
  }

  // ajax
  public function ajax_set_todo_state() {
    $srv = $this->srv->setState();
  }

}
