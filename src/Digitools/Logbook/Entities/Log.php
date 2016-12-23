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
  
  public function __construct() {
    $this->tags = new ArrayCollection();
  }
  
  function get_id() {
    return $this->id;
  }

  function get_user() {
    return $this->user;
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
  
}
