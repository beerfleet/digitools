<?php

namespace digi\eslTools\Service\Validation;

use Valitron\Validator;

class ClientValidation extends Validation {
  
  public function addRules() {
    $val->rule('email', 'e-mail');
  }
}