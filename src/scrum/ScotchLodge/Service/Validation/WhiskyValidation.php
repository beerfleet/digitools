<?php
namespace scrum\ScotchLodge\Service\Validation;

use Valitron\Validator;

/**
 * EventValidation
 *
 * @author joeri broos
 */
class WhiskyValidation extends Validation {
    
    public function addRules() {
        $val = $this->getVal();
        $val->rule('required', 'name');
        $val->rule('required', 'region');
        $val->rule('required', 'distillery');
        $val->rule('required', 'barrel');
        $val->rule('required', 'age');
        $val->rule('numeric', 'age');
        $val->rule('integer', 'age');
        $val->rule('required', 'alcohol');
    }
  
}