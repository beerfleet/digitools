<?php

/*
 * Here's where the dayly logs will be kept
 */

namespace Digitools\Logbook\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * A text fragment containing the description of activities for 
 * a specific day
 * @author jan
 */
class Log {
  private $id;
  private $user;
  private $created;
  private $tags;
  private $entry;
  private $modified;
  private $delete_flag;
  private $logfiles;

  public function __construct() {
    $this->tags = new ArrayCollection();
    $this->logfiles = new ArrayCollection();
  }

  function get_logfiles() {
    return $this->logfiles;
  }

  function set_logfiles($logfiles) {
    $this->logfiles = $logfiles;
  }
  
  function add_logfile(Logfile $logfile) {
    $this->logfiles[] = $logfile;
  }

  function get_delete_flag() {
    return $this->delete_flag;
  }

  function set_delete_flag($delete_flag) {
    $this->delete_flag = $delete_flag;
  }

  function get_modified() {
    return $this->modified;
  }

  function set_modified(\DateTime $modified) {
    $this->modified = $modified;
  }

  function get_id() {
    return $this->id;
  }

  function get_user() {
    return $this->user;
  }

  public function getUserID() {
    return $this->user->getId();
  }

  function get_created() {
    return $this->created;
  }

  function set_id($id) {
    $this->id = $id;
  }

  function set_user($user) {
    $this->user = $user;
  }

  function set_created($created) {
    $this->created = $created;
  }

  function get_tags() {
    return $this->tags;
  }

  function set_tags($tags) {
    $this->tags = $tags;
  }

  public function add_tag($tag) {
    $this->tags[] = $tag;
  }

  function get_entry() {
    return $this->entry;
  }

  function set_entry($entry) {
    $this->entry = $entry;
  }

  function contains_tags($tags) {
    $owned_tags = $this->get_tags();
    $tag_id_arr = [];
    foreach ($owned_tags as $tag) {
      $tag_id_arr[] = $tag->get_id();
    }

    foreach ($tags as $tag_id => $checked) {
      if (array_search($tag_id, $tag_id_arr) === false) {
        return false;
      }
    }

    return true;
  }

}
