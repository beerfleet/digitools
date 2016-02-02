<?php

namespace scrum\ScotchLodge\Service\Validation;

use Valitron\Validator;

/**
 * Description of WhiskySearchValidation
 *
 * @author jan van biervliet
 */
class WhiskySearchValidation extends Validation {    
  
  public function __construct($app, $em) {
    parent::__construct($app, $em);
  }
  
  public function addRules() {
    /* @var $val Validator */
    $val = $this->getVal();
    $val->rule('numeric', 'min_age');
    $val->rule('numeric', 'max_age');
    $val->rule('min', 'min_age', 0);        
  }

}
