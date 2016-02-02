<?php

namespace scrum\ScotchLodge\Controllers;

use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Registration\RegistrationService;
use scrum\ScotchLodge\Service\Profile\ProfileService;
use scrum\ScotchLodge\Entities\User;

/**
 * RegistrationController controller
 *
 * @author jan van biervliet
 */
class RegistrationController extends Controller {
  /* @var $srv RegistrationService */

  private $srv;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->srv = new RegistrationService($em, $app);
  }

  public function register() {
    $postcodes = $this->srv->getPostcodes();
    $globals = $this->getGlobals();
    $this->getApp()->render('Registration/register.html.twig', array('globals' => $globals, 'postcodes' => $postcodes));
  }

  public function processRegistration() {
    try {
      $user = $this->srv->processRegistration();
      if ($user) {
        $profile_srv = new ProfileService($this->getEntityManager(), $this->getApp());
        $profile_srv->processRegistration($user);
        
        $url = $this->getApp()->urlFor('user_register_ok');
        $this->getApp()->redirect($url);
      } else {
        $errors = $this->srv->getErrors();
        $postcodes = $this->srv->getPostcodes();
        $this->getApp()->render('Registration\register.html.twig', array('globals' => $this->getGlobals(), 'errors' => $errors, 'postcodes' => $postcodes));
      }
    } catch (Exception $e) {
      $this->getApp()->render('probleem.html.twig');
    }
  }

  public function registrationConfirm() {
    $app = $this->getApp();
    $app->flash('info', 'A mail has been sent. Please verify by following the email instructions.');
    $app->redirect($app->urlFor('main_page'));
  }

}
