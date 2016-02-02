<?php

namespace scrum\ScotchLodge\Service\WhiskyLike;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\WhiskyLike;
use \scrum\ScotchLodge\Service\Profile\ProfileService;
use \scrum\ScotchLodge\Service\Whisky\WhiskyService;

/**
 * WhyskiLikeService
 *
 * @author olivier masudi
 */
class WhiskyLikeService {

  private $em;
  private $app;

  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
  }

  public function addlike() {

    $whiskyid = $this->app->request->post('whiskyid');
    $likeid = $this->app->request->post('likeid');
    $userid = $this->app->request->post('userid');
    $status = $this->app->request->post('status');
    $usersrv = new ProfileService($this->em, $this->app);
    $user = $usersrv->searchUserById($userid);
    $whiskysrv = new WhiskyService($this->em, $this->app);
    $whisky = $whiskysrv->retrieveWhiskyById($whiskyid);
    $WhiskyLike = $this->isalreadyLike($whiskyid, $userid);
    $c = $WhiskyLike;
    if ($WhiskyLike) {
//$WhiskyLike->setUser($user);
//$WhiskyLike->setWhisky($whisky);
      $WhiskyLike->setState($status);
    }
    else {
      $WhiskyLike = new WhiskyLike();
      $WhiskyLike->setUser($user);
      $WhiskyLike->setWhisky($whisky);
      $WhiskyLike->setState($status);
    }
    $this->em->persist($WhiskyLike);
    $this->em->flush();
    return $WhiskyLike;
  }

  public function isalreadyLike($id_comment, $id_user) {
    $like = $this->em->getRepository('scrum\ScotchLodge\Entities\WhiskyLike')->findBy(array('user' => $id_user, 'whisky' => $id_comment));
    if (count($like) > 0) {
      return $like[0];
    }
    else {
      return null;
    }
  }

  public function isalreadyLikeMulti($id_user) {
    $like = $this->em->getRepository('scrum\ScotchLodge\Entities\WhiskyLike')->findBy(array('user' => $id_user));
    if (count($like) > 0) {
      foreach ($like as $value) {
        $index = "like" . $value->getWhisky()->getId();
        $tab[$index] = $value->getState();
      }
      return $tab;
    }
    else {
      return null;
    }
  }

  public function retrieveWhiskyLikeById($id) {
    $whiskyLike = $this->em->getRepository('scrum\ScotchLodge\Entities\WhiskyLike')->find($id);
    if (count($whiskyLike) > 0) {
      return $whiskyLike;
    }
    else {
      return null;
    }
  }

}
