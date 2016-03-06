<?php

namespace digi\eslTools\Service\Validation;

use Valitron\Validator;

class RegistrationValidation extends Validation {

  public function __construct($app, $em) {
    // custom rule unique email
    Validator::addRule('unique_email', function($field, $value, array $params) use ($em, $app) {
      $email = $app->request->post('e-mail');
      $repo = $em->getRepository('digi\eslTools\Entities\User');
      $result = $repo->findBy(array('email' => $email));
      return count($result) < 1;
    }, 'bestaat al');
    
    // custom rule unique username
    Validator::addRule('unique_username', function($field, $value, array $params) use ($em, $app) {
      $username = $app->request->post('gebruikersnaam');
      $repo = $em->getRepository('digi\eslTools\Entities\User');
      $result = $repo->findBy(array('username' => $username));
      return count($result) < 1;      
    }, 'bestaat al');
    
    parent::__construct($app, $em);
    // custom rule
  }
  
  public function addRules() {
    $val = $this->getVal();
    $val->rule('required', 'gebruikersnaam');
    $val->rule('unique_username', 'gebruikersnaam');
    $val->rule('email', 'e-mail');
    $val->rule('unique_email', 'e-mail');    
    $val->rule('required', 'e-mail');
    $val->rule('required', 'wachtwoord');   
    $val->rule('equals', 'wachtwoord', 'herhaal_wachtwoord')->message('Wachtwoorden komen niet overeen.');        
  }
}
