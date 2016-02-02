<?php

namespace scrum\ScotchLodge\Service\Validation;

/**
 * Description of EmailNotBlankValidation
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
