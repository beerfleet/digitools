<?php

namespace Digitools\eslTools\Service\Profile;

use Doctrine\ORM\EntityManager;
use Digitools\EslTools\Entities\User;
use Digitools\eslTools\Service\Validation\ProfileValidation as Val;
use Digitools\EslTools\Service\Registration\RegistrationService;
use Digitools\eslTools\Service\Validation\PasswordValidation;
use Digitools\Common\Entities\Constants;

/**
 * ProfileService
 *
 * @author jan van biervliet
 */
class ProfileService {

  private $em;
  private $app;
  private $errors;

  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    $this->errors = null;
  }

  public function retrieveUserByUsername($username) {
    $repo = $this->em->getRepository('Digitools\EslTools\Entities\User');
    $user = $repo->findBy(array('username' => $username));
    return count($user) > 0 ? $user[0] : null;
  }

  public function retrieveUserByEmail($email) {
    $repo = $this->em->getRepository('Digitools\eslTools\Entities\User');
    $user = $repo->findBy(array('email' => $email));
    return count($user) > 0 ? $user[0] : null;
  }

  public function confirmPassword($username, $password) {
    /* var $user User */
    $user = $this->retrieveUserByUsername($username);
    $this->user = $user;

    if (isset($user) && $user != null) {
      $hash = $user->getPassword();

      if (password_verify($password, $hash)) {
        return $user;
      } else {
        return null;
      }
    } else {
      return false;
    }
  }

  public function dataIsValid() {
    $val = new Val($this->app, $this->em);
    $validated = $val->validate();
    $this->errors = $val->getErrors();
    return $validated;
  }
  
  public function update_user_by_id($id) {
    $user = $this->get_user_by_id($id);
    $this->updateUser($user);
  }

  public function updateUser(User $user) {
    $app = $this->app;
    $em = $this->em;
    $repo = $em->getRepository('Digitools\eslTools\Entities\User');

    $password = $app->request->post('wachtwoord');
    if (isset($password) && trim($password) != '') {
      $hash = password_hash($password, CRYPT_BLOWFISH);
      $user->setPassword($hash);
    }

    $first_name = $app->request->post('voornaam');
    if ($user->getFirstName() != $first_name) {
      $user->setFirstName($first_name);
    }

    $surname = $app->request->post('naam');
    if ($user->getSurname() != $surname) {
      $user->setSurname($surname);
    }

    $postcode_id = $app->request->post('postcode');
    if ($user->getPostcode()->getId() != $postcode_id) {
      $reg_srv = new RegistrationService($em, $app);
      $postcode = $reg_srv->getPostcodeObject($postcode_id);
      $user->setPostcode($postcode);
    }

    $address = $app->request->post('adres');
    if ($user->getAddress() != $address) {
      $user->setAddress($address);
    }

    $em->persist($user);
    $em->flush();
  }

  /**
   * Returns the user containing the generated token, 
   * if email provided exists in DB, or null if it doesnt
   * @return User
   */
  public function createPasswordToken() {
    $email = $this->app->request->post('e-mail');
    $user = $this->retrieveUserByEmail($email);
    if (isset($user) && $user != null) {
      $token = uniqid(mt_rand(), true);
      $user->setPasswordToken($token);
      $this->em->persist($user);
      $this->em->flush();
      return $user;
    }
    return null;
  }

  public function createFirstTimeToken($email) {
    $user = $this->retrieveUserByEmail($email);
    if (isset($user) && $user != null) {
      $token = uniqid(mt_rand(), true);
      $user->setPasswordToken($token);
      $this->em->persist($user);
      $this->em->flush();
      return $user;
    }
    return null;
  }

  public function mailUserResetToken($user) {
    $root_path = getenv('HTTP_HOST');
    $app = $this->app;
    $rel_path_raw = trim($app->urlFor('reset_token_verify'), '\x3A');
    $rel_path = str_replace(":token", "", $rel_path_raw);
    $url = "http://$root_path" . $rel_path . $user->getPasswordToken();
    $message = wordwrap("Aanvraag wachtwoord herstel: " . $user->getUsername() .
            ". Klik " . $url . " om te herstellen.");
    $headers = 'From: webmaster@digi.eu';
    mail($user->getEmail(), 'Digi Tools wachtwoord herstel dienst.', $message, $headers);
  }

  public function mailUserLogonToken($user) {
    $root_path = getenv('HTTP_HOST');
    $app = $this->app;
    $rel_path_raw = trim($app->urlFor('logon_token_verify'), '\x3A');
    $rel_path = str_replace(":token", "", $rel_path_raw);
    $url = "http://$root_path" . $rel_path . $user->getPasswordToken();
    $message = wordwrap("Hello " . $user->getUsername() .
            ". Klik " . $url . " om uw registratie te activeren.");
    $headers = 'From: webmaster@digi.eu';
    mail($user->getEmail(), 'Bevestig uw profiel.', $message, $headers);
  }

  public function processRegistration($user) {
    $user = $this->createFirstTimeToken($user->getEmail());
    $this->mailUserLogonToken($user);
  }

  public function getErrors() {
    return $this->errors;
  }

  public function getUser() {
    return $this->user;
  }
  
  public function get_current_user() {
    $username = $_SESSION['user'];
    $this->retrieveUserByUsername($username);
    return $this->retrieveUserByUsername($username);
  }
  
  public function get_user_by_id_and_postcodes($id) {
    $result['user'] = $this->get_user_by_id($id);
    $reg_srv = new RegistrationService($this->em, $this->app);
    $result['postcodes'] = $reg_srv->getPostcodes();
    return $result;
  }
  
  public function get_user_by_id($id) {    
    $em = $this->em;
    $repo = $em->getRepository(Constants::USER);
    $user = $repo->find($id);
    return $user;
  }

  public function searchUserByToken($token) {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\eslTools\Entities\User');
    $user = $repo->findBy(array('password_token' => $token));
    return count($user) == 0 ? null : $user[0];
  }

  /* Olivier */

  public function searchUserById($id) {

    $em = $this->em;
    $repo = $em->getRepository('Digitools\eslTools\Entities\User');
    $user = $repo->find($id);
    if (isset($user) && $user != null)
      return $user;
    else
      return null;
  }

  public function searchUserByUsername($username) {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\eslTools\Entities\User');
    return $repo->findOneByUsername($username);
  }

  /* Olivier */

  public function isPasswordValid() {
    $val = new PasswordValidation($this->app, $this->em);
    $validate = $val->validate();
    $this->errors = $val->getErrors();
    return $validate;
  }

  public function changePassword() {
    $app = $this->app;
    $user_id = $app->request->post('id');
    $password = $app->request->post('wachtwoord');
    $hash = password_hash($password, CRYPT_BLOWFISH);
    $em = $this->em;
    $repo = $em->getRepository('Digitools\eslTools\Entities\User');
    $user = $repo->find($user_id);
    $user->setPassword($hash);
    $user->setEnabled(1);
    $em->persist($user);
    $em->flush();
  }

  public function clearToken($user = null) {
    $em = $this->em;
    if ($user == null) {
      $app = $this->app;
      $user_id = $app->request->post('id');
      $repo = $em->getRepository('Digitools\eslTools\Entities\User');
      $user = $repo->find($user_id);
    }
    $user->resetPasswordToken();
    $em->merge($user);
    $em->flush();
  }

  /* @var $user User */

  public function setEnabledState($user) {
    $user->setEnabled(1);
    $em = $this->em;
    $em->merge($user);
    $em->flush();
  }

  public function enableUser($user) {
    $this->clearToken($user);
    $this->setEnabledState($user);
  }

  public function clearAllTokens() {
    $em = $this->em;
    $repo = $em->getRepository('Digitools\eslTools\Entities\User');
    $repo->clearTokens();
  }

  public function storeLoginTime($user) {
    $em = $this->em;
    $date = new \DateTime();
    $user->setLastLogin($date);
    $em->persist($user);
    $em->flush();
  }

  public function showAllUsers() {
    $em = $this->em;
    $userRepository = $em->getRepository('Digitools\eslTools\Entities\User');
    $members = $userRepository->findAll();

    return $members;
  }
  
  /* ajax */
  public function toggle_admin_state() {
    $app = $this->app;
    $state = $app->request->post('state');
    $user_id = $app->request->post('user_id');
    $user = $this->get_user_by_id($user_id);
    $user->setAdmin($state === "true" ? 1 : 0);
    $em = $this->em;
    $em->persist($user);
    $em->flush();
  }
  
  public function toggle_enabled_state() {
    $app = $this->app;
    $state = $app->request->post('state');
    $user_id = $app->request->post('user_id');
    $user = $this->get_user_by_id($user_id);
    $user->setEnabled($state === "true" ? 1 : 0);
    $em = $this->em;
    $em->persist($user);
    $em->flush();
  }

}
