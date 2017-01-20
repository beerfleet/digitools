<?php

/*
 * Here's where the dayly logs will be kept
 */

namespace Digitools\Logbook\Entities;

use Digitools\Logbook\Entities\Log;

/**
 * A text fragment containing the description of activities for 
 * a specific day
 * @author jan
 */
class Logfile {

  private $id;
  private $log;
  private $path;
  private $filename;

  function get_id() {
    return $this->id;
  }

  function get_log() {
    return $this->log;
  }

  function get_path() {
    return $this->path;
  }

  function get_filename() {
    return $this->filename;
  }

  function set_id($id) {
    $this->id = $id;
  }

  function set_log(Log $log) {
    $this->log = $log;
  }

  function set_path($path) {
    $this->path = $path;
  }

  function set_filename($filename) {
    $this->filename = $filename;
  }

}
