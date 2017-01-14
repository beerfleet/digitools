<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Todo\Entities\Repo;

use Doctrine\ORM\EntityRepository;
use Digitools\EslTools\Entities\User;
use Digitools\Todo\Entities\Todo;


/**
 * Description of LogRepo
 *
 * @author jan
 */
class TodoRepo extends EntityRepository {

  public function find_user_todos(User $user) {
    $em = $this->getEntityManager();        
    return $user->get_todos();
  }
  
  public function find_unfinished_user_todos(User $user) {
    $user_todos = $this->find_user_todos($user);
    /* @var $user_todo Todo */
    $results = [];
    foreach ($user_todos as $user_todo) {
      if ($user_todo->getFinishstate() != 1) {
        $results[] = $user_todo;
      }
    }
    return $results;
  }

}
