<?php

namespace scrum\ScotchLodge\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Profile\ProfileService;
use scrum\ScotchLodge\Entities\User;


class MemberController extends Controller {

  private $profileServ;
  private $em;
  private $app;

public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->profileServ = new ProfileService($em, $app);
    $this->em=$em;
    $this->app=$app;
}



public function member() {
    $app = $this->getApp();
    $globals = $this->getGlobals();
    $srv = new ProfileService($this->em, $this->app);
    $userlist = $srv->showalluser();
    if ($this->isUserLoggedIn()) {
      $u = $this->getUser();
      $app->render('Members\member_list.html.twig', array('globals' => $globals, 'members' => $userlist, 'user' => $u));
    } else 
    $app->render('Members\member_list.html.twig', array('globals' => $globals, 'members' => $userlist));
    }
}