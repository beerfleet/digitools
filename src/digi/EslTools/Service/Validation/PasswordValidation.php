<?php

namespace scrum\ScotchLodge\Service\Validation;

use Valitron\Validator;

/**
 * Description of PasswordValidation
 *
 * @author jan van biervliet
 */
class PasswordValidation extends Validation {

  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'password');
    $val->rule('required', 'password_repeat')
        ->message('Repeat password is required');
    $val->rule('equals', 'password', 'password_repeat')
        ->message('Passwords don\'t match');
  }
    

}
