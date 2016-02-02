<?php

namespace scrum\ScotchLodge\Service\Profile;

use Doctrine\ORM\EntityManager;
use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Service\Validation\ProfileValidation as Val;
use \scrum\ScotchLodge\Service\Registration\RegistrationService;
use scrum\ScotchLodge\Service\Validation\PasswordValidation;

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
    $repo = $this->em->getRepository('scrum\ScotchLodge\Entities\User');
    $user = $repo->findBy(array('username' => $username));
    return count($user) > 0 ? $user[0] : null;
  }

  public function retrieveUserByEmail($email) {
    $repo = $this->em->getRepository('scrum\ScotchLodge\Entities\User');
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

  public function updateUser(User $user) {
    $app = $this->app;
    $em = $this->em;
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');

    $password = $app->request->post('password');
    if (isset($password) && trim($password) != '') {
      $hash = password_hash($password, CRYPT_BLOWFISH);
      $user->setPassword($hash);
    }

    $first_name = $app->request->post('first_name');
    if ($user->getFirstName() != $first_name) {
      $user->setFirstName($first_name);
    }

    $surname = $app->request->post('surname');
    if ($user->getSurname() != $surname) {
      $user->setSurname($surname);
    }

    $postcode_id = $app->request->post('postcode');
    if ($user->getPostcode()->getId() != $postcode_id) {
      $reg_srv = new RegistrationService($em, $app);
      $postcode = $reg_srv->getPostcodeObject($postcode_id);
      $user->setPostcode($postcode);
    }

    $address = $app->request->post('address');
    if ($user->getAddress() != $address) {
      $user->setAddress($address);
    }

    /* Olivier */
    $isAdmin = $app->request->post('is_admin');
    if ($user->isAdmin() != $isAdmin) {
      $user->setAdmin($isAdmin);
    }

    $can_review = $app->request->post('can_review');
    if ($user->canReview() != $can_review) {
      $user->setCanReview($can_review);
    }


    $can_create_event = $app->request->post('can_create_event');
    if ($user->canCreateEvent() != $can_create_event) {
      $user->setCanCreateEvent($can_create_event);
    }

    $can_create_category = $app->request->post('can_create_category');
    if ($user->canCreateCategory() != $can_create_category) {
      $user->setCanCreateCategory($can_create_category);
    }
    
    $isEnabled = $app->request->post('enabled');
    if($user->isEnabled() != $isEnabled){
        if(!isset($isEnabled)){
            $user->setEnabled(0);
        }else{
            $user->setEnabled($isEnabled);
        }
    }
    
    $isDeleted = $app->request->post('deleted');
    if($user->isDeleted() != $isDeleted){
        if(!isset($isDeleted)){
            $user->setDeleted(0);
        }else{
            $user->setDeleted(1);
        }
        if($isDeleted){
            $user->setEnabled(0);
        }
    }

    /* Olivier */

    $em->persist($user);
    $em->flush();
  }

  /**
   * Returns the user containing the generated token, 
   * if email provided exists in DB, or null if it doesnt
   * @return User
   */
  public function createPasswordToken() {
    $email = $this->app->request->post('email');
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
    $message = wordwrap("Password reset link requested: " . $user->getUsername() .
        ". Click " . $url . " to complete.");
    $headers = 'From: webmaster@thescotchlodge.com';
    mail($user->getEmail(), 'The Scotch Lodge password reset', $message, $headers);
  }

  public function mailUserLogonToken($user) {
    $root_path = getenv('HTTP_HOST');
    $app = $this->app;
    $rel_path_raw = trim($app->urlFor('logon_token_verify'), '\x3A');
    $rel_path = str_replace(":token", "", $rel_path_raw);
    $url = "http://$root_path" . $rel_path . $user->getPasswordToken();
    $message = wordwrap("Hello " . $user->getUsername() .
        ". Click " . $url . " to complete the registration.");
    $headers = 'From: webmaster@thescotchlodge.com';
    mail($user->getEmail(), 'The Scotch Lodge profile verification.', $message, $headers);
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

  public function searchUserByToken($token) {
    $em = $this->em;
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');
    $user = $repo->findBy(array('password_token' => $token));
    return count($user) == 0 ? null : $user[0];
  }

  /* Olivier */

  public function searchUserById($id) {

    $em = $this->em;
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');
    $user = $repo->find($id);
    if (isset($user) && $user != null)
      return $user;
    else
      return null;
  }

  public function searchUserByUsername($username) {
    $em = $this->em;
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');
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
    $password = $app->request->post('password');
    $hash = password_hash($password, CRYPT_BLOWFISH);
    $em = $this->em;
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');
    $user = $repo->find($user_id);
    $user->setPassword($hash);
    $em->persist($user);
    $em->flush();
  }

  public function clearToken($user = null) {
    $em = $this->em;
    if ($user == null) {
      $app = $this->app;
      $user_id = $app->request->post('id');
      $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');
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
    $repo = $em->getRepository('scrum\ScotchLodge\Entities\User');
    $repo->clearTokens();
  }

  public function storeLoginTime($user) {
    $em = $this->em;
    $date = new \DateTime();
    $user->setLastLogin($date);
    $em->persist($user);
    $em->flush();
  }

  /* Olivier */

  public function showalluser() {
    $em = $this->em;
    $userRepository = $em->getRepository('scrum\ScotchLodge\Entities\User');
    $members = $userRepository->findBy(array('is_deleted' => 0));

    return $members;
  }

  /* End  Olivier */



}
