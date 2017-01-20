<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Logbook\Entities\Repo;

use Doctrine\ORM\EntityRepository;

/**
 * Description of LogfileRepo
 *
 * @author jan
 */
class LogfileRepo extends EntityRepository {

  public function find_double($log_id, $dir, $file) {
    $sql = "SELECT * "
            . "FROM log_file "
            . "WHERE log_id = $log_id"
            . " AND path = '$dir'"
            . " AND filename = '$file'";
    $query = $this->getEntityManager()->getConnection()->prepare($sql);    
    $query->execute();
    return $query->fetch();
  }
  
  public function fetch_log_files($log_id) {
    $sql = "SELECT * "
            . "FROM log_file "
            . "WHERE log_id = $log_id";
    $query = $this->getEntityManager()->getConnection()->prepare($sql);    
    $query->execute();
    return $query->fetchAll();
  }

}
