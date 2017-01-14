<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Todo\Entities\Repo;

use Doctrine\ORM\EntityRepository;
use Digitools\EslTools\Entities\User;


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

}
