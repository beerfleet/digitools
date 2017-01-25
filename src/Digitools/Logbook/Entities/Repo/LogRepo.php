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

  /**
   * Returns logs for the logged on user
   */
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
  
  public function find_all_sorted_by_deletion_mark() {
    $em = $this->getEntityManager();
    $dql = "SELECT l FROM Digitools\Logbook\Entities\Log l ORDER BY l.delete_flag DESC";           
    $result = $em->createQuery($dql)->getResult();
    return $result;
  }
  
  public function toggle_log_tag_entry($log_id, $tag_id) {
    $sql = "SELECT * FROM log_tag WHERE log_tag.log_id = $log_id AND log_tag.tag_id = $tag_id";
    $em = $this->getEntityManager();
    $tag = $em->getConnection()->executeQuery($sql);
    $result = $tag->fetch();
    if ($result) {
      $sql_delete = "DELETE FROM log_tag WHERE log_id = $log_id AND tag_id = $tag_id";
      $em->getConnection()->executeQuery($sql_delete);      
    } else {
      $sql_insert = "INSERT INTO log_tag (log_id, tag_id) VALUES ($log_id, $tag_id)";
      $em->getConnection()->executeQuery($sql_insert);
    }
  }
  
  public function select_query($sql) {
    $em = $this->getEntityManager();
    $tags = $em->getConnection()->executeQuery($sql);
    return $tags->fetchAll();
  }
  
  public function fetch_tag_by_desc($desc) {
    $em = $this->getEntityManager();
    $sql = "SELECT * FROM tag WHERE tag_desc = '" . $desc . "'";
    $tag = $em->getConnection()->executeQuery($sql);
    return $tag->fetch();
  }
  
  public function find_tags_sort_alfabetic() {
    $dql = "SELECT t FROM Digitools\Logbook\Entities\Tag t ORDER BY t.tag_desc";
    return $this->getEntityManager()->createQuery($dql)->getResult();
  }
  

}
