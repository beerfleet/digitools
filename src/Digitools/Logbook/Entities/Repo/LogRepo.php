<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Logbook\Entities\Repo;

use Doctrine\ORM\EntityRepository;
use Digitools\EslTools\Entities\User;


/**
 * Description of LogRepo
 *
 * @author jan
 */
class LogRepo extends EntityRepository {

  /* @var $user User */
  public function find_ordered_lifo($user) {
    $sql = "SELECT * FROM log WHERE user_id = " . $user->getId() . " ORDER BY created DESC";    
    $em = $this->getEntityManager();
    $list = $em->getConnection()->executeQuery($sql);
    
    return $list->fetchAll();
  }

}
