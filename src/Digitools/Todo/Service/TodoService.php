<?php

namespace Digitools\Todo\Service;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use Digitools\Todo\Entities\Todo;
use Digitools\Todo\Entities\Priority;

class TodoService {
  private $em;
  private $app;
  private $errors;
  
  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    $this->errors = null;
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
    $tododatetime_str = str_replace('/', '-', $tododate) . " " . $todotime;
    $tododatetime = date_create($tododatetime_str);
    
    $priority_id = $app->request->post('priority');
    $priority = $this->getPriorityById($priority_id);
    
    $creationdate_str = date('Y-m-d H:i:s');
    $creationdate = date_create($creationdate_str);
    $todo = new Todo();
    $todo->setCreationdate($creationdate);
    $todo->setTitle($title);
    $todo->setTododate($tododatetime);
    $todo->setPriority($priority);
    
    $em =  $this->em;
    $em->persist($todo);
    $em->flush();
    
    $app->flash('info', $todo . " is added");
  }
}