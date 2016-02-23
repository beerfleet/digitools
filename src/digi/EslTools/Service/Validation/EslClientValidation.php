<?php

namespace digi\eslTools\Service\Validation;

use Valitron\Validator;

class EslClientValidation extends Validation {
  
  public function addRules() {
    $val = $this->getVal();
    $val->rule('email', 'e-mail')->message('{field} is geen geldig e-mail adres');
    $val->rule('numeric', 'synergie');
    
  }
}