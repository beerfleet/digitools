<?php

namespace scrum\ScotchLodge\Controllers;

use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Profile\ProfileService;
use scrum\ScotchLodge\Service\Registration\RegistrationService;
use scrum\ScotchLodge\Service\Validation\EmailNotBlankValidation as EmailVal;
use scrum\ScotchLodge\Entities\User;

/**
 * ProfileController User logon, profile related actions
 *
 * @author jan van biervliet
 */
class ProfileController extends Controller {
  /* var $srv ProfileService */
  private $srv;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new ProfileService($em, $app);
  }

  /* logon */

  public function logon() {
    $globals = $this->getGlobals();
    $this->getApp()->render('Profile\logon.html.twig', array('globals' => $globals));
  }

  public function verifyUserCredentials() {
    $app = $this->getApp();
    $username = $app->request->post('username');
    $password = $app->request->post('password');
    $verified = $this->srv->confirmPassword($username, $password);
    if ($verified) {
      $this->logonIfEnabled();
    } else {
      $app->flash('error', 'Invalid credentials');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  public function logOff() {
    unset($_SESSION['user']);
    session_unset();
    $app = $this->getApp();
    $app->redirect($app->urlFor('main_page'));
  }

  public function logonIfEnabled() {
    $app = $this->getApp();
    $username = $app->request->post('username');
    /* @var $user User */
    $user = $this->srv->retrieveUserByUsername($username);
    $this->srv->clearToken($user);
    if ($user->isEnabled()) {
      // logon
      
      $_SESSION['user'] = $user->getUsername();
      $this->srv->storeLoginTime($user);
      $app->redirect($app->urlFor('main_page'));
    } else {
      $app->flash('error', 'Access denied.');
      $app->redirect($app->urlFor('main_page'));
    }
  }

  /* profile */

  public function showProfile() {
    $app = $this->getApp();
    if ($this->isUserLoggedIn()) {
      $globals = $this->getGlobals();
      $u = $this->getUser();
      $app->render('Profile\profile_show.html.twig', array('globals' => $globals, 'user' => $u));
    } else {
      $app->flash('error', 'U moet aangemeld zijn om uw profiel te bekijken.');
      $app->redirect($app->urlFor('user_logon'));
    }
  }
  
  public function editProfile() {
    $app = $this->getApp();
    $reg_srv = new RegistrationService($this->getEntityManager(), $this->getApp());
    $postcodes = $reg_srv->getPostcodes();
    $g = $this->getGlobals();    
    $app->render('Profile\profile_edit.html.twig', array('globals' => $this->getGlobals(), 'postcodes' => $postcodes));
  }
  
  
/* olivier */
  public function editProfileAdmin($username) {
    $app = $this->getApp();
    $reg_srv = new RegistrationService($this->getEntityManager(), $this->getApp());
    $postcodes = $reg_srv->getPostcodes();
    $g = $this->getGlobals();
  
    $usertoedit = $this->srv->retrieveUserByUsername($username);
    
    
    $app->render('Profile\profile_edit_admin.html.twig', array('globals' => $this->getGlobals(), 'postcodes' => $postcodes, 'usertoedit' => $usertoedit));
  }
  
    
    public function storeChangesAdmin() {
    $app = $this->getApp();      
    $usertoedit = $this->srv->retrieveUserByUsername($app->request->post('username'));       
    $this->srv->updateUser($usertoedit);
    $app->flash('info', 'User profile updated.');
    $app->redirect($app->urlFor('profile_editadmin',array('username'=> $usertoedit->getUsername())));

  }
  
  /* olivier */
  public function storeChanges() {
    $app = $this->getApp();
    if ($this->srv->dataIsValid()) {
      $this->srv->updateUser($this->getUser());
      $app->flash('info', 'User profile updated.');
      $app->redirect($app->urlFor('profile_show'));
    } else {
      $reg_srv = new RegistrationService($this->getEntityManager(), $this->getApp());
      $pc = $reg_srv->getPostcodes();
      $app->render('Profile\profile_edit.html.twig', array('globals' => $this->getGlobals(), 'errors' => $this->srv->getErrors(), 'postcodes' => $pc));
    }
  }

   
  /* password reset */
  public function processToken($token) {
    $app = $this->getApp();
    $srv = $this->srv;
    $user = $srv->searchUserByToken($token);
    if ($user != null) {
      $app->render('Profile/password_reset.html.twig', array('globals' => $this->getGlobals(), 'user_id' => $user->getId()));
    } else {
      //$srv->clearAllTokens(); // safety measure
      //$app->flash('error', 'Invalid or expired token. Please try to request a new password');
      $app->redirect($app->urlFor('error_404'));
    }
  }

  public function PasswordResetRequest() {
    $app = $this->getApp();
    $app->render('Profile/password_reset_request.html.twig', array('globals' => $this->getGlobals()));
  }

  public function passwordResetProcess() {
    $app = $this->getApp();
    $em = $this->getEntityManager();

    $val = new EmailVal($app, $em);
    if ($val->validate()) {
      $user = $this->srv->createPasswordToken();
      if ($user != null) {
        $this->srv->mailUserResetToken($user);
      }
      $app->flash('info', 'A mail will be sent shortly if the email address provided is valid.');
      $app->redirect($app->urlFor('main_page'));
    } else {
      $app->flash('error', 'E-mail address is not valid.');
      $app->redirect($app->urlFor('password_reset_request'));
    }
  }

  public function processNewPassword() {
    $srv = $this->srv;
    $app = $this->getApp();
    if ($srv->isPasswordValid()) {
      $srv->changePassword();
      $srv->clearToken();
      $app->flash('info', 'Password has been changed');
      $app->redirect($app->urlFor('main_page'));
    } else {
      $id = $app->request->post('id');
      $errors = $srv->getErrors();
      $app->render('Profile/password_reset.html.twig', array('globals' => $this->getGlobals(), 'user_id' => $id, 'errors' => $errors));
    }
  }
  
  /* registration */
  public function processLogonToken($token) {
    $app = $this->getApp();
    $srv = $this->srv;
    $user = $srv->searchUserByToken($token);
    if ($user != null) {
      $srv->enableUser($user);
      $app->flash('info', 'The token is verified. You are now granted access.');
      $app->redirect($app->urlFor('main_page'));
    } else {
      $app->redirect($app->urlFor('error_404'));
    }
  }

  public function showProfileOfUserWithId($id) {           
    $app = $this->getApp();    
    $srv = $this->srv;
    $usertoview = $srv->searchUserById($id);
    if ($usertoview != null) {
      $app->render('Profile/profile_show_by_id.html.twig', array('globals' => $this->getGlobals(), 'usertoview' => $usertoview));
    } else {
      $app->flash('error', 'Invalid user. Please try again');
      $app->redirect($app->urlFor('main_page'));
    }
    
  }
  
  public function showProfileOfUserWithUsername($username) {
    $app = $this->getApp();
    $srv = $this->srv;
    $usertoview = $srv->searchUserByUsername($username);
    if ($usertoview != null) {
      $app->render('Profile/profile_show_by_id.html.twig', array('globals' => $this->getGlobals(), 'usertoview' => $usertoview));
    } else {
      $app->flash('error', 'Invalid user. Please try again');
      $app->redirect($app->urlFor('main_page'));
    }
  }
  
  public function showAllUserComments($id) {
    $app = $this->getApp();
    $srv = $this->srv;
    $user = $srv->searchUserById($id);
    if ($user == null) {
      $app->redirect('error_404');
    }
    $app->render('Comments/profile_comments.html.twig', array('globals' => $this->getGlobals(), 'comments' => $user->getComments(), 'user' => $user));
  }
 
  public function showAllUserWhiskies($id) {
    $app = $this->getApp();
    $user = $this->srv->searchUserById($id);
    if ($user == null) {
      $app->redirect('error_404');
    }
    $app->render('Whiskies/profile_whiskies.html.twig', array('globals' => $this->getGlobals(), 'whiskies' => $user->getWhiskysCreated(), 'user' => $user));
  }

  public function showAllUserEvents($id) {
    $app = $this->getApp();
    $user = $this->srv->searchUserById($id);
    if ($user == null) {
      $app->redirect('error_404');
    }
    $app->render('Events/profile_events.html.twig', array('globals' => $this->getGlobals(), 'events' => $user->getEventsCreated(), 'user' => $user));
  }
  
}
