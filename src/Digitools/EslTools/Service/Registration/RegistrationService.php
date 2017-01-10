<?php

namespace Digitools\EslTools\Service\Registration;

use Digitools\EslTools\Entities\User;
use Digitools\EslTools\Service\Validation\RegistrationValidation as Val;
use Digitools\Common\Entities\Constants;
use Doctrine\ORM\EntityManager;

/**
 * RegistrationService registration services
 *
 * @author jan van biervliet
 */
class RegistrationService {
  /* @var $em EntityManager */
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
    $username = $app->request->post('gebruikersnaam');
    $email = $app->request->post('e-mail');
    $password = $app->request->post('wachtwoord');
    $hash = password_hash($password, CRYPT_BLOWFISH);
    $first_name = $app->request->post('voornaam');
    $surname = $app->request->post('naam');
    $postcode = $app->request->post('postcode');
    $address = $app->request->post('adres');

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
    //$repo = $em->getRepository('Digitools\EslTools\Entities\Postcode');
    $repo = $em->getRepository('Digitools\EslTools\Entities\Postcode');
    $postcodes = $repo->findAll();
    return $postcodes;
  }
  
  public function getPostcodesByCity() {
    $em = $this->getEm();
    $repo = $em->getRepository('Digitools\EslTools\Entities\Postcode');
    $postcodes = $repo->findBy(array(), ['town' => 'ASC']);
    return $postcodes;
  }

  public function getPostcodeObject($postcode_id) {
    $em = $this->getEm();
    $repo = $em->getRepository('Digitools\EslTools\Entities\Postcode');
    $pc_obj = $repo->find($postcode_id);
    return $pc_obj;
  }

  public function getErrors() {
    return $this->errors;
  }

}
