<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Exceptions;

/**
 * Description of LogExistsException
 *
 * @author jan
 */
class LogExistsException extends \Exception {
  public function __construct($message = "Er bestaat voor vandaag al een log-entry.", $code = 0, \Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}
