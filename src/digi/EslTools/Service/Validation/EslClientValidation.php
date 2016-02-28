<?php

namespace digi\eslTools\Service\Validation;

use Valitron\Validator;
use Slim\Slim;

class EslClientValidation extends Validation {
  
  public function __construct($app, $em) {
    /* @var $app Slim */
    Validator::addRule('unique_storename', function($field, $value, array $params) use($em, $app) {
      $storename = $app->request->post('winkelnaam');
      $repo = $em->getRepository('digi\eslTools\Entities\Store');
      $result = $repo->findBy(array('storename' => $storename));
      return count($result) < 1;
    }, 'bestaat al');
    
    parent::__construct($app, $em);
  }
  
  public function addRules() {
    $val = $this->getVal();
    $email = $this->getApp()->request->post('e-mail');
    $val->rule('email', 'e-mail')->message("$email is geen geldig e-mail adres");
    $val->rule('numeric', 'synergie');
    $winkel = $this->getApp()->request->post('winkelnaam');
    $val->rule('unique_storename', 'winkelnaam')->message("$winkel bestaat al");
  }
}