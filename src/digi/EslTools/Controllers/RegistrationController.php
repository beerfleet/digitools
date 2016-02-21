<?php

namespace digi\eslTools\Controllers;

use digi\eslTools\Controllers\Controller;
use digi\eslTools\Service\Registration\RegistrationService;
use digi\eslTools\Service\Profile\ProfileService;
use digi\eslTools\Entities\User;

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
    $app->flash('info', 'Check uw mail, u ontvangt dadelijk een e-mail met instructies om uw registratie te activeren.');
    $app->redirect($app->urlFor('main_page'));
  }

}
