<?php

namespace scrum\ScotchLodge\Service\Validation;

use Valitron\Validator;

class ProfileValidation extends Validation {

  public function __construct($app, $em) {
    parent::__construct($app, $em);    
  }
  
  public function addRules() {
    $val = $this->getVal();    
    //$val->rule('required', 'password');
    $val->rule('required', 'first_name')->message('First name is required');
    $val->rule('required', 'surname');
    $val->rule('equals', 'password', 'password_repeat')->message('Passwords do not match');
    $val->rule('required', 'address');
  }
}
