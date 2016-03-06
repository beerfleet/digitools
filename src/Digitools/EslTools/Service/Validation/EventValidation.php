<?php
namespace scrum\ScotchLodge\Service\Validation;

use Valitron\Validator;

/**
 * EventValidation
 *
 * @author joeri broos
 */
class EventValidation extends Validation {

  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'title');
    $val->rule('required', 'postcode');
    $val->rule('required', 'address');
    $val->rule('required', 'event_date');
    $val->rule('date', 'event_date');
    $val->rule('required', 'event_stop');
    $val->rule('date', 'event_stop');
  }
  
}