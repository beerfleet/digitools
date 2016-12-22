<?php

namespace Digitools\EslTools\Service\Validation;

/**
 * E-mail validatie
 *
 * @author jan van biervliet
 */
class EmailNotBlankValidation extends Validation {

  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'email');
    $val->rule('email', 'email');    
    
  }

}
