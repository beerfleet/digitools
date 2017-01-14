<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Digitools\Todo\Service\Validation;

use Digitools\EslTools\Service\Validation\Validation;


/**
 * Description of LogbookValidation
 *
 * @author jan
 */
class TodoValidation extends Validation {

  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'title')->message("Titel is verplicht");
    $val->rule('required', 'tododate')->message("Einddatum is verplicht");
    $val->rule('required', 'todotime')->message("Einduur is verplicht");
  }

}
