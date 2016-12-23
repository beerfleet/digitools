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
    $dql = "SELECT * FROM Digitools\Logbook\Entities\Log WHERE user_id = :id ORDER BY created DESC";
    $query = $this->getEntityManager()->createQuery($dql);
    $query->setParameter('id', $user->getId());
    return $query->execute();
  }

}
