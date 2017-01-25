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
use Digitools\Logbook\Entities\Logfile;
use Digitools\EslTools\Entities\User;
use Digitools\Logbook\Entities\Tag;
use Digitools\Common\Entities\Constants;

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
    /* @var $app Slim */
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
      $log->set_modified(new \DateTime('0000-00-00 00:00:00'));
      $log->set_delete_flag(0);
      $log->set_user($this->user);
      $tags = $this->acquire_tags_from_input();
      try { // valid = store
        $em->persist($log);
        $em->flush();
        if ($tags) {
          $this->append_tags_to_log($log, $tags);
        }
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
      $tag = $em->getRepository(Constants::TAG)->find($id);
      $log->add_tag($tag);
    }
    $em->persist($log);
    $em->flush();
  }

  public function get_logs_and_tags() {
    $result = ['logs' => $this->list_log_entries_lifo(), 'tags' => $this->list_tags()];
    return $result;
  }

  public function get_logs() {
    return $this->list_log_entries_lifo();
  }

  public function get_untagged_logs() {
    $logs = $this->get_logs_and_tags();
    $untagged = [];
    foreach ($logs['logs'] as $log) {
      if (!$log->has_tags()) {
        $untagged[] = $log;
      }
    }
    $result['logs'] = $untagged;
    $result['tags'] = $logs['tags'];
    return $result;
  }

  public function get_log_by_id($id) {
    $repo = $this->em->getRepository(Constants::LOG);
    return $repo->find($id);
  }

  /**
   * Sets delete state for a logbook entry. Admin / moderator decides if it is deleted.
   * @return true if succeeded, otherwise false
   */
  public function log_set_delete_state() {
    $app = $this->app;
    $log_id = $app->request->post('id');
    $deletion_flag = $app->request->post('state');
    /* @var $log Log */
    $log = $this->get_log_by_id($log_id);
    $log->set_delete_flag($deletion_flag == 'true' ? 1 : 0);
    $em = $this->em;
    $em->persist($log);
    $em->flush();
  }

  public function list_tags() {
    $em = $this->em;
    $repo = $em->getRepository(Constants::TAG);
    return $repo->find_tags_sort_alfabetic();
  }

  /**
   * Return logs for the active user
   * @return Log[]
   */
  public function list_log_entries_lifo() {
    $em = $this->em;
    $repo = $em->getRepository(Constants::LOG);

    /* @var $repo LogRepo */
    return $repo->find_ordered_lifo($this->user);
  }

  public function retrieve_all_logs() {
    //return $this->em->getRepository(Constants::LOG)->findAll();
    return $this->em->getRepository(Constants::LOG)->find_all_sorted_by_deletion_mark();
  }

  /**
   * Return Log by id. Returns null if user is not logged on
   * @param integer $id
   * @return Log
   */
  public function load_entry_data_by_id($id) {

    $repo = $this->em->getRepository(Constants::LOG);
    /* @var $log Log */
    $log = $repo->find($id);
    // check whether the logged on user is the one who wrote this entry
    /* @var $entry_usr_obj User */
    $entry_usr_id = $log->get_user()->getId();
    //$entry_usr_id = $log->get_user()->get_id();
    $logged_on_usr = $this->user->getId();
    return $entry_usr_id == $logged_on_usr ? $log : null;
  }

  public function handle_file_upload() {
    $files = $_FILES['upload_file'];
    if (strlen($files['name'][0]) >= 1) {
      $root_dir = $_SERVER['DOCUMENT_ROOT'];
      $config = include $root_dir . '/config/config.php';
      $images_root_dir = $config['images']['root_dir'];
      $target_dir = $images_root_dir . '/' . $this->user->getUsername();
      $finfo_mime_type = finfo_open(FILEINFO_MIME_TYPE);

      foreach ($files['name'] as $key => $filename) {
        $allow_upload[$key] = 1;
      }

      foreach ($files['name'] as $key => $filename) {
        $target_file[$key] = $target_dir . '/' . basename($files['name'][$key]);

        $mime_types[$key] = finfo_file($finfo_mime_type, $files['tmp_name'][$key]);
        if (!array_search($mime_types[$key], $config['images']['allowed_ext'])) {
          $allow_upload[$key] = 0;
        }

        $file_size[$key] = filesize($files['tmp_name'][$key]);
        if ($file_size[$key] > $config['images']['max_size_bytes']) {
          $allow_upload[$key] = 0;
        }
      }
      $uploaded_files = [];
      foreach ($files['name'] as $key => $filename) {
        if ($allow_upload[$key] === 1) {
          if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
          }
          move_uploaded_file($files['tmp_name'][$key], $target_file[$key]);
          $uploaded_files[$key]['filename'] = basename($files['name'][$key]);
        }
      }
      return ['dir' => $target_dir, 'files' => $uploaded_files];
    }
    return null;
  }

  public function check_if_logfile_exists($log_id, $dir, $filename) {
    $result = $this->em->getRepository(Constants::LOGFILE)
            ->find_double($log_id, $dir, $filename);
    return $result;
  }

  /* @var $log Log */

  public function store_file_data_to_db($log, $files) {

    if ($files) {
      foreach ($files['files'] as $key => $filename) {
        $logfile_exists = $this->check_if_logfile_exists($log->get_id(), $files['dir'], $filename['filename']);
        if (!$logfile_exists) {
          $logfile = new Logfile();
          $logfile->set_path($files['dir']);
          $logfile->set_filename($filename['filename']);
          $logfile->set_log($log);
          $this->em->persist($logfile);
        }
      }
    }
  }

  public function store_modified_entry($id) {
    $app = $this->app;
    $em = $this->em;
    $val = new LogbookValidation($app, $em);
    if ($val->validate()) {
      /* @var $log Log */
      $repo = $em->getRepository(Constants::LOG);
      $log = $repo->find($id);
      $log->set_entry($app->request->post('log_entry'));
      $log->set_modified(new \DateTime());

      $uploaded_files = $this->handle_file_upload();
      $this->store_file_data_to_db($log, $uploaded_files);

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

  /**
   * Filter the logs containing ALL provided filter_tags
   * @param Log $logs colleciton of logs
   * @param Tag $tags tags used to filter the given logs
   */
  private function filter_logs_by_tags($logs, $filter_tags) {
    $result = [];
    foreach ($logs as $log) {
      if ($log->contains_all_tags($filter_tags)) {
        $result[] = $log;
      }
    }
    return $result;
  }
  
  public function filter_logs_by_one_or_more_tags($logs, $filter_tags) {
    $result = [];
    foreach ($logs as $log) {
      if ($log->contains_some_of_the_tags($filter_tags)) {
        $result[] = $log;
      }
    }
    return $result;
  }

  public function get_tag_names_from_ids($tag_ids) {
    $tag_name_array = [];
    foreach ($tag_ids as $id => $tag_id) {
      $tag_name_array[] = $this->em->getRepository(Constants::TAG)->find($id);
    }
    return $tag_name_array;
  }

  public function get_filtered_logs_and_tags() {
    $app = $this->app;

    $result = $this->get_logs_and_tags();
    $unfiltered_log_list = $result['logs'];
    $tag_list = $result['tags'];
    $filter_tags = $app->request->post('tags_chk');

    if ($app->request->post('search_logic') === 'and') {
      $filtered_result = $this->filter_logs_by_tags($unfiltered_log_list, $filter_tags);
    } else {
      $filtered_result = $this->filter_logs_by_one_or_more_tags($unfiltered_log_list, $filter_tags);       
    }


    $result['logs'] = $filtered_result;

    $selected_tags = $this->get_tag_names_from_ids($filter_tags);
    $selected_tags_string = "";
    /* @var $tag Tag */
    foreach ($selected_tags as $tag) {
      $selected_tags_string .= $tag->get_tag_desc() . ", ";
    }
    $result['selected_tags_string'] = rtrim($selected_tags_string, ", ");

    return $result;
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
    $repo = $this->em->getRepository(Constants::LOG);
    $repo->toggle_log_tag_entry($log_id, $tag_id);
  }

  public function find_tag_by_description($desc) {
    $repo = $this->em->getRepository(Constants::TAG);
    $result = $repo->fetch_tag_by_desc($desc);
    return $result;
  }

  public function delete_tag($id) {
    $em = $this->em;
    $repo = $em->getRepository(Constants::TAG);
    $tag = $repo->find($id);
    $em->remove($tag);
    $em->flush();
  }

  public function delete_tags() {
    $tags = $this->app->request->post('tags');
    foreach ($tags as $tag) {
      $this->delete_tag($tag);
    }
  }

  public function get_errors() {
    return $this->errors;
  }

  /* @var $em EntityManager */

  public function delete_log_by_id($id) {
    $log = $this->get_log_by_id($id);
    $this->em->remove($log);
  }

  public function delete_marked_logs() {
    $app = $this->app;
    $marked = $app->request->post('log_ids');
    foreach ($marked as $key => $id) {
      $this->delete_log_by_id($id);
    }
    $this->em->flush();
  }

  public function fetch_log_files($log_id) {
    return $this->em->getRepository(Constants::LOGFILE)->fetch_log_files($log_id);
  }

  public function fetch_log_image_paths() {
    $log_id = $this->app->request->post('log_id');
    $log_files = $this->fetch_log_files($log_id);
    $result = [];
    foreach ($log_files as $log_file) {
      $result[] = $log_file['path'] . '/' . $log_file['filename'];
    }
    return $result;
  }

}
