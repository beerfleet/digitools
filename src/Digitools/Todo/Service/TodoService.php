<?php

namespace Digitools\Todo\Service;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Todo\Entities\Todo;
use Digitools\Todo\Entities\Priority;
use Digitools\eslTools\Service\Profile\ProfileService;
use Digitools\Common\Entities\Constants;
use Doctrine\ORM\Repository;

class TodoService {

  private $em;
  private $app;
  private $errors;

  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    $this->errors = null;
  }
  
  public function getTodoById($id) {
    $repo = $this->em->getRepository('Digitools\Todo\Entities\Todo');
    return $repo->find($id);
  }

  public function getAllTodos() {
    $repo = $this->em->getRepository('Digitools\Todo\Entities\Todo');
    return $repo->findAll();
  }
  
  public function get_todos_from_user() {
    $app = $this->app;
    $profile_srv = new ProfileService($this->em, $app);
    $user = $profile_srv->get_current_user();
    /* @var $em EntityManager */
    $em = $this->em;
    $todo_repo = $em->getRepository(Constants::TODO);
    $user_todos = $todo_repo->find_user_todos($user);
    return $user_todos;
  }

  public function getPriorities() {
    $repo = $this->em->getRepository('Digitools\Todo\Entities\Priority');
    return $repo->findAll();
  }

  public function getPriorityById($id) {
    $repo = $this->em->getRepository('Digitools\Todo\Entities\Priority');
    return $repo->find($id);
  }

  public function storeTodo() {
    $app = $this->app;
    $title = $app->request->post('title');
    $tododate = $app->request->post('tododate');
    $todotime = $app->request->post('todotime');
    if ($todotime == "") {
      $todotime = "00:00:00";
    }
    $tododatetime_str = str_replace('/', '-', $tododate) . " " . $todotime;
    $tododatetime = date_create($tododatetime_str);

    $priority_id = $app->request->post('priority');
    $priority = $this->getPriorityById($priority_id);

    $creationdate_str = date('Y-m-d H:i:s');
    $creationdate = date_create($creationdate_str);
    $todo = new Todo();
    $todo->setCreationdate($creationdate);
    $todo->setTitle($title);
    if ($tododate != "") {
      $todo->setTododate($tododatetime);
    }
    $todo->setPriority($priority);

    $em = $this->em;
    $em->persist($todo);
    $em->flush();

    $app->flash("info", "'" . $todo . "' is added");
  }
  
  // ajax
  public function setState() {
    /* @var $app Slim */
    $app = $this->app;
    $id = $app->request->post('id');
    $state = $app->request->post('state');
    /* @var $todo Todo */
    $todo = $this->getTodoById($id);
    $todo->setFinishstate($state);
    $em = $this->em;
    $em->persist($todo);
    $em->flush();
  }

}
