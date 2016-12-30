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
   /* $sql = "SELECT * FROM log WHERE user_id = " . $user->getId() . " ORDER BY created DESC";    
    $em = $this->getEntityManager();
    $list = $em->getConnection()->executeQuery($sql);
    
    return $list->fetchAll();*/
    $repo = "Digitools\Logbook\Entities\Log";
    $dql = "SELECT l FROM " . $repo . " l ORDER BY l.created DESC";
    $all_logs = $this->getEntityManager()->createQuery($dql)->getResult();
    $logs_per_user = [];
    foreach ($all_logs as $log) {
      
      if ($log->get_user()->getId() == $user->getId()) {
        $logs_per_user[] = $log;
      }
    }
    return $logs_per_user;
  }

}
