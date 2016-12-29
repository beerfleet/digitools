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
class Tag {
  private $id;
  private $logs;
  private $tag_desc;
    
  public function __construct() {
    $this->logs = new ArrayCollection();    
  }    
  
  function get_id() {
    return $this->id;
  }

  function get_logs() {
    return $this->logs;
  }

  function get_tag_desc() {
    return $this->tag_desc;
  }

  function set_id($id) {
    $this->id = $id;
  }

  function set_logs($logs) {
    $this->logs = $logs;
  }

  function set_tag_desc($tag_desc) {
    $this->tag_desc = $tag_desc;
  }

}
