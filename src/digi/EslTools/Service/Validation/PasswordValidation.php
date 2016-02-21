<?php

namespace digi\eslTools\Service\Validation;

use Valitron\Validator;

/**
 * Description of PasswordValidation
 *
 * @author jan van biervliet
 */
class PasswordValidation extends Validation {

  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'wachtwoord');
    $val->rule('required', 'herhaal_wachtwoord')
        ->message('Herhaal wachtwoord is verplicht');
    $val->rule('equals', 'wachtwoord', 'herhaal_wachtwoord')
        ->message('Wachtwoorden komen niet overeen.');
  }
    

}
