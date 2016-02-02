<?php

namespace scrum\ScotchLodge\Service\Registration;

use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Service\Validation\RegistrationValidation as Val;

/**
 * RegistrationService registration services
 *
 * @author jan van biervliet
 */
class RegistrationService {

  private $em;
  private $app;
  private $errors;

  function __construct($em, $app) {
    $this->app = $app;
    $this->em = $em;
    $this->errors = null;
  }

  function getEm() {
    return $this->em;
  }

  function getApp() {
    return $this->app;
  }

  public function processRegistration() {
    $em = $this->getEm();
    $app = $this->getApp();
    $val = new Val($app, $em);
    if (!$val->validate()) {
      $this->errors = $val->getErrors();
      return false;
    }

    /* @var $user User */
    $user = new User();
    $username = $app->request->post('username');
    $email = $app->request->post('email');
    $password = $app->request->post('password');
    $hash = password_hash($password, CRYPT_BLOWFISH);
    $first_name = $app->request->post('first_name');
    $surname = $app->request->post('surname');
    $postcode = $app->request->post('postcode');
    $address = $app->request->post('address');

    $user->setUsername($username);
    $user->setEmail($email);
    $user->setPassword($hash);
    $user->setFirstName($first_name);
    $user->setSurname($surname);
    $user->setAddress($address);
    $user->setEnabled(0);
    $user->setDeleted(0);

    $postcode_object = $this->getPostcodeObject($postcode);
    $user->setPostcode($postcode_object);

    $em->persist($user);
    $em->flush();
    
    return $user;
  }

  public function getPostcodes() {
    $em = $this->getEm();
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\Postcode');
    $postcodes = $repo->findAll();
    return $postcodes;
  }

  public function getPostcodeObject($postcode_id) {
    $em = $this->getEm();
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\Postcode');
    $pc_obj = $repo->find($postcode_id);
    return $pc_obj;
  }

  public function getErrors() {
    return $this->errors;
  }

}
