<?php

namespace scrum\ScotchLodge\Controllers;

use scrum\ScotchLodge\Controllers\Controller;

/**
 * FormController controller
 *
 * @author jan van biervliet
 */
class FormController extends Controller {

  public function __construct($em, $app) {
    parent::__construct($em, $app);
  }
  
  public function form() {
    $app = $this->getApp();
    if ($app->request->isPost()) {
      $app->render('Test\form_posted.html.twig', array('app' => $app));
    }
    if ($app->request->isGet()) {
      $app->render('Test\form.html.twig', array());
    }
  }
}
