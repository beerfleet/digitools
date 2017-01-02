<?php

/*
 * Logbook actions backend
 */

namespace Digitools\Logbook\Service;

use Slim\Slim;
use Doctrine\ORM\EntityManager;
use Digitools\Exceptions\LogExistsException;
use Digitools\Logbook\Service\Validation\LogbookValidation;
use Digitools\Logbook\Entities\Repo\LogRepo;
use Digitools\Logbook\Entities\Log;
use Digitools\EslTools\Entities\User;
use Digitools\Logbook\Entities\Tag;

/**
 *
 * @author jan
 */
class LogService {

  private $errors;
  private $user;
  /* @var $em EntityManager */
  private $em;
  private $app;

  function __construct($em, $app, $user) {
    $this->errors = null;
    $this->em = $em;
    $this->app = $app;
    $this->user = $user;
  }

  /*
   * If todays log exixts, throw exception
   * #demonstrate #exception #handling #slim
   * 
   * Needs $app->config('debug', false);
   */

  private function check_log_exists() {
    $app = $this->app;
    $app->error(function ( LogExistsException $e) use ($app) {
      $app->flash('error', $e->getMessage());
      $app->redirect($app->urlFor('log_new'));
    });

    // error if todays log is already createg
    $sql = "SELECT * FROM log WHERE DATE(created) = DATE(NOW())";
    $conn = $this->em->getConnection();
    $todays_log = $conn->fetchAll($sql);
    if ($todays_log > 0) {
      throw new LogExistsException();
    }
  }

  private function acquire_tags_from_input() {
    $app = $this->app;
    $tags = $app->request->post('tags_chk');
    return $tags;
  }

  public function store_log_entry() {
    // validate       
    /* @var $app Slim */
    $app = $this->app;
    $em = $this->em;


    // is the input valid?
    $val = new LogbookValidation($app, $em);
    if ($val->validate()) {
      /* @var $log Log */
      $log = new Log();
      $log->set_entry($app->request->post('log_entry'));
      $log->set_created(new \DateTime());
      $log->set_user($this->user);
      $tags = $this->acquire_tags_from_input();
      try { // valid = store
        $em->persist($log);
        $em->flush();
        $this->append_tags_to_log($log, $tags);
      } catch (Exception $e) {
        echo($e->getMessage());
      }
    } else { // invalid = spout error
      $this->errors = $val->getErrors();
    }
  }

  /* var $log Log */

  private function append_tags_to_log($log, $tags) {
    $em = $this->em;
    foreach ($tags as $id => $value) {
      $tag = $em->getRepository('Digitools\Logbook\Entities\Tag')->find($id);
      $log->add_tag($tag);
    }
    $em->persist($log);
    $em->flush();
  }

  public function get_logs_and_tags() {
    $result = ['logs' => $this->list_log_entries_lifo(), 'tags' => $this->list_tags()];
    return $result;
  }

  public function list_tags() {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\Logbook\Entities\Tag');
    return $repo->findAll();
  }

  public function list_log_entries_lifo() {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\Logbook\Entities\Log');

    /* @var $repo LogRepo */
    return $repo->find_ordered_lifo($this->user);
  }

  public function load_entry_data_by_id($id) {

    $repo = $this->em->getRepository('Digitools\Logbook\Entities\Log');
    /* @var $log Log */
    $log = $repo->find($id);

    // check whether the logged on user is the one who wrote this entry
    /* @var $entry_usr_obj User */
    $entry_usr_id = $log->get_user()->getId();
    //$entry_usr_id = $log->get_user()->get_id();
    $logged_on_usr = $this->user->getId();
    return $entry_usr_id == $logged_on_usr ? $log : null;
  }

  public function store_modified_entry($id) {
    $app = $this->app;
    $em = $this->em;
    $val = new LogbookValidation($app, $em);
    if ($val->validate()) {
      /* @var $log Log */
      $repo = $em->getRepository('Digitools\Logbook\Entities\Log');
      $log = $repo->find($id);
      $log->set_entry($app->request->post('log_entry'));
      try {
        $em->persist($log);
        $em->flush();
      } catch (Exception $e) {
        echo($e->getMessage());
      }
    } else {
      $this->errors = $val->getErrors();
      var_dump($this->errors);
    }
  }

  private function build_condition_for_filtered_search($tags) {

    /* $select = "SELECT * FROM log as l, log_tag as lt WHERE id IN (";
     */
    $current_user_id = $this->user->getId();
    $select = "SELECT * "
            . "FROM log as l "
            . "JOIN log_tag as lt ON l.id = lt.log_id "
            . "JOIN tag as t ON lt.tag_id = t.id ";

    if (sizeof($tags) > 1) {
      $select .= "WHERE lt.tag_id IN (";
      foreach ($tags as $id => $value) {
        if ($id == key($tags)) {
          $select .= $id;
        } else {
          $select .= ",$id";
        }
      }
      $select .= ")";
    } else {
      $id = key($tags);
      $select = "SELECT * "
              . "FROM log as l "
              . "JOIN log_tag as lt ON l.id = lt.log_id "
              . "JOIN tag as t ON lt.tag_id = t.id "
              . "WHERE t.id = $id ";
    }
    $select .= " AND l.user_id = $current_user_id";
    return $select;
  }

  public function get_filtered_logs($tags) {
    $sql = $this->build_condition_for_filtered_search($tags);
    $repo = $this->em->getRepository('Digitools\Logbook\Entities\Log');
    $logs = $repo->select_query($sql);
    return $logs;
  }

  public function add_tag_if_not_exists($tag) {
    $query = "SELECT * FROM tag WHERE tag_desc = '" . strtolower($tag) . "'";
    $em = $this->em;
    $conn = $em->getConnection();
    $result = $conn->fetchAll($query);
    header('Content-type: application/json');
    // tag added success
    if (count($result) == 0) {
      $this->add_tag($tag);
      echo json_encode(['status' => 1, 'tag' => $tag]);
      // failure
    } else {
      echo json_encode(['status' => 0]);
    }
  }

  public function add_tag($tag_desc) {
    $tag = new Tag();
    $tag->set_tag_desc($tag_desc);
    $em = $this->em;
    $em->persist($tag);
    $em->flush();
  }

  public function store_new_tag_status($log_id, $tag_id) {
    $repo = $this->em->getRepository('Digitools\Logbook\Entities\Log');
    $repo->toggle_log_tag_entry($log_id, $tag_id);
  }

  public function get_errors() {
    return $this->errors;
  }

}
