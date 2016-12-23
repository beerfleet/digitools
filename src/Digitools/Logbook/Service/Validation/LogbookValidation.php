<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Logbook\Service\Validation;

use Digitools\EslTools\Service\Validation\Validation;


/**
 * Description of LogbookValidation
 *
 * @author jan
 */
class LogbookValidation extends Validation {

  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'log_entry');
  }

}
