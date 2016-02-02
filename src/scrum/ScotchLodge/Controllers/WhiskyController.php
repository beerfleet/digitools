<?php

namespace scrum\ScotchLodge\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Whisky\WhiskyService;
use scrum\ScotchLodge\Service\Region\RegionService;
use scrum\ScotchLodge\Service\Distillery\DistilleryService;
use scrum\ScotchLodge\Service\Barrel\BarrelService;
use scrum\ScotchLodge\Service\Blend\BlendService;
use scrum\ScotchLodge\Service\Country\CountryService;
use scrum\ScotchLodge\Service\Category\CategoryService;
use scrum\ScotchLodge\Entities\Whisky;
use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Service\WhiskyLike\WhiskyLikeService;
use scrum\ScotchLodge\Service\CommentLike\CommentLikeService;

/**
 * WhiskyController controller
 * 
 * @author joeri broos 
 */
class WhiskyController extends Controller {
  /* @var $whiskysrv WhiskyService */

  private $whiskysrv;
  private $em;
  private $app;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->whiskysrv = new WhiskyService($em, $app);
    $this->em = $em;
    $this->app = $app;
  }

  /**
   * Render the page to add a new whisky.
   */
  public function addWhisky() {
    $app = $this->app;
    $user = $this->getUser();

    /* @var $user User */
    if (isset($user)) {
      if ($user->isAdmin() || $user->canReview()) {
        $regsrv = new RegionService($this->em, $this->app);
        $regions = $regsrv->getRegions();
        $distsrv = new DistilleryService($this->em, $this->app);
        $distillerys = $distsrv->getDistillerys();
        $barsrv = new BarrelService($this->em, $this->app);
        $barrels = $barsrv->getBarrels();
        $blendsrv = new BlendService($this->em, $this->app);
        $blends = $blendsrv->getBlends();
        $countrysrv = new CountryService($this->em, $this->app);
        $countries = $countrysrv->getCountries();
        $categorysrv = new CategoryService($this->em, $this->app);
        $categories = $categorysrv->getCategories();
        $globals = $this->getGlobals();
        $this->getApp()->render('Whisky/new_whisky.html.twig', array('globals' => $globals, 'regions' => $regions, 'distillerys' => $distillerys, 'barrels' => $barrels, 'blends' => $blends, 'countries' => $countries, 'categories' => $categories));
      }
    }
    else {
      /* @var $app Slim */
      $app->flash('error', 'Access denied');
      $app->redirectTo('main_page');
    }
  }

  /**
   * Render the page to insert a whisky.
   */
  public function insertWhisky() {
    try {
      $user = $this->getUser();
      $whisky = $this->whiskysrv->addWhisky($user);
      if ($whisky) {
        $app = $this->app;
        $app->flash('info', 'Successful added whisky ' . $whisky->getName() . ' .');
        $app->redirect($app->urlFor('main_page'));
      }
      else {
        $errors = $this->whiskysrv->getErrors();
        $regsrv = new RegionService($this->em, $this->app);
        $regions = $regsrv->getRegions();
        $distsrv = new DistilleryService($this->em, $this->app);
        $distillerys = $distsrv->getDistillerys();
        $barsrv = new BarrelService($this->em, $this->app);
        $barrels = $barsrv->getBarrels();
        $blendsrv = new BlendService($this->em, $this->app);
        $blends = $blendsrv->getBlends();
        $countrysrv = new CountryService($this->em, $this->app);
        $countries = $countrysrv->getCountries();
        $globals = $this->getGlobals();
        $categorysrv = new CategoryService($this->em, $this->app);
        $categories = $categorysrv->getCategories();
        $this->getApp()->render('Whisky/new_whisky.html.twig', array('globals' => $globals, 'errors' => $errors, 'regions' => $regions, 'distillerys' => $distillerys, 'barrels' => $barrels, 'blends' => $blends, 'countries' => $countries, 'categories' => $categories));
      }
    } catch (Exception $ex) {
      $this->getApp()->render('probleem.twig.html');
    }
  }

  /**
   * Render the page to add a new whisky.
   */
  public function editWhisky($id) {
    $whisky = $this->whiskysrv->retrieveWhiskyById($id);
    $regsrv = new RegionService($this->em, $this->app);
    $regions = $regsrv->getRegions();
    $distsrv = new DistilleryService($this->em, $this->app);
    $distillerys = $distsrv->getDistillerys();
    $barsrv = new BarrelService($this->em, $this->app);
    $barrels = $barsrv->getBarrels();
    $blendsrv = new BlendService($this->em, $this->app);
    $blends = $blendsrv->getBlends();
    $countrysrv = new CountryService($this->em, $this->app);
    $countries = $countrysrv->getCountries();
    $globals = $this->getGlobals();
    $this->getApp()->render('Whisky/edit_whisky.html.twig', array('globals' => $globals, 'whisky' => $whisky, 'regions' => $regions, 'distillerys' => $distillerys, 'barrels' => $barrels, 'blends' => $blends, 'countries' => $countries));
  }

  /**
   * Render the page to insert a whisky.
   * @param int $id 
   */
  public function updateWhisky($id) {
    try {
      $whisky_old = $this->whiskysrv->retrieveWhiskyById($id);
      $whisky = $this->whiskysrv->updateWhisky($whisky_old);
      if ($whisky) {
        $app = $this->app;
        $app->flash('info', 'Successful update whisky ' . $whisky->getName() . ' .');
        $app->redirect($app->urlFor('main_page'));
      }
      else {
        $errors = $this->whiskysrv->getErrors();
        $regsrv = new RegionService($this->em, $this->app);
        $regions = $regsrv->getRegions();
        $distsrv = new DistilleryService($this->em, $this->app);
        $distillerys = $distsrv->getDistillerys();
        $barsrv = new BarrelService($this->em, $this->app);
        $barrels = $barsrv->getBarrels();
        $blendsrv = new BlendService($this->em, $this->app);
        $blends = $blendsrv->getBlends();
        $countrysrv = new CountryService($this->em, $this->app);
        $countries = $countrysrv->getCountries();
        $globals = $this->getGlobals();
        $this->getApp()->render('Whisky/edit_whisky.html.twig', array('globals' => $globals, 'errors' => $errors, 'whisky' => $whisky_old, 'regions' => $regions, 'distillerys' => $distillerys, 'barrels' => $barrels, 'blends' => $blends, 'countries' => $countries));
      }
    } catch (Exception $ex) {
      $this->getApp()->render('probleem.twig.html');
    }
  }

  /* Olivier */

  public function advanced_search_whisky() {
    $regsrv = new RegionService($this->em, $this->app);
    $regions = $regsrv->getRegions();

    $distsrv = new DistilleryService($this->em, $this->app);
    $distillerys = $distsrv->getDistillerys();

    $bottlers = $distsrv->getDistillerys();
    $barsrv = new BarrelService($this->em, $this->app);
    $barrels = $barsrv->getBarrels();

    $blendsrv = new BlendService($this->em, $this->app);
    $blends = $blendsrv->getBlends();

    $globals = $this->getGlobals();
    $this->getApp()->render('Whisky/advanced_search.html.twig', array('globals' => $globals, 'regions' => $regions, 'distillerys' => $distillerys, 'barrels' => $barrels, 'bottlers' => $bottlers, 'blends' => $blends));
  }

  public function advanced_search_whisky_result() {

    $globals = $this->getGlobals();
    $whisky = $this->whiskysrv->advanced_search_whisky_result($this->em, $this->app);
    $whiskylikesrv = new WhiskyLikeService($this->em, $this->app);


    $user = $globals['user'];
    if (isset($globals['user'])) {
      $whiskylike = $whiskylikesrv->isalreadyLikeMulti($globals["user"]->getId());
      $this->getApp()->render('Whisky/advanced_search_result.html.twig', array('globals' => $globals, 'whiskys' => $whisky, 'whiskylike' => $whiskylike));
    }
    else {
      $this->getApp()->render('Whisky/advanced_search_result.html.twig', array('globals' => $globals, 'whiskys' => $whisky));
    }


    if ($globals["user"] != null)
      $whiskylike = $whiskylikesrv->isalreadyLikeMulti($globals["user"]->getId());

    $this->getApp()->render('Whisky/advanced_search_result.html.twig', array('globals' => $globals, 'whiskys' => $whisky, 'whiskylike' => $whiskylike));
  }

  public function show_whisky_by_id($id) {
    try {

      $globals = $this->getGlobals();
      $whisky = $this->whiskysrv->retrieveWhiskyById($id);
      $whisky = $this->whiskysrv->ViewWhisky($whisky);
      if ($whisky) {

        $user = $globals['user'];

        if (isset($user)) {
          //$whiskylikesrv = new WhiskyLikeService($this->em, $this->app);
          //$whiskylike = $whiskylikesrv->isalreadyLikeMulti($globals["user"]->getId());
          //$commentlikesrv = new CommentLikeService($this->em, $this->app);
          //$commentlike = $commentlikesrv->isalreadyLikeMulti($globals["user"]->getId());
          //$this->getApp()->render('Whisky/show_whisky_by_id.html.twig', array('globals' => $globals, 'whisky' => $whisky, 'whiskylike' => $whiskylike, 'commentlike', $commentlike));
          $this->getApp()->render('Whisky/show_whisky_by_id.html.twig', array('globals' => $globals, 'whisky' => $whisky));
        }
        else {
          $this->getApp()->render('Whisky/show_whisky_by_id.html.twig', array('globals' => $globals, 'whisky' => $whisky));
        }

        $whiskylikesrv = new WhiskyLikeService($this->em, $this->app);

        if ($globals["user"] != null)
          $whiskylike = $whiskylikesrv->isalreadyLikeMulti($globals["user"]->getId());

        $commentlikesrv = new CommentLikeService($this->em, $this->app);

        if ($globals["user"] != null)
          $commentlike = $commentlikesrv->isalreadyLikeMulti($globals["user"]->getId());

        $this->getApp()->render('Whisky/show_whisky_by_id.html.twig', array('globals' => $globals, 'whisky' => $whisky, 'whiskylike' => $whiskylike, 'commentlike', $commentlike));
      }
      else {
        $app = $this->getApp();
        $app->flash('error', 'The requested whisky does not exist');
        $app->redirectTo('error_404');
      }
    } catch (Exception $ex) {
      $this->getApp()->render('probleem.twig.html');
    }
  }

  /*   * ** Olivier */

  public function ajax_addComment($whisky_id) {
    /* @var  $app Slim */
    $app = $this->app;
    if ($app->request()->isAjax()) {
      $message = $app->request->post('text');

      if (trim($message) != '') {
        $srv = $this->whiskysrv;
        $srv->addWhiskyComment($whisky_id, $this->getUser(), $message);
      }
    }
    else {
      $app->redirectTo('error_404');
    }
  }

}
