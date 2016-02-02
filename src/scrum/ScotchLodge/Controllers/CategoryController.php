<?php

namespace scrum\ScotchLodge\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\Category\CategoryService;
use scrum\ScotchLodge\Service\Registration\RegistrationService;
use scrum\ScotchLodge\Entities\Category;
use scrum\ScotchLodge\Entities\User;

/**
 * CategoryController controller
 * 
 * @author joeri broos 
 */
class CategoryController extends Controller {
  /* @var $catsrv CategoryService */

  private $catsrv;
  private $em;
  private $app;

  public function __construct($em, $app) {
    parent::__construct($em, $app);
    $this->catsrv = new CategoryService($em, $app);
    $this->em = $em;
    $this->app = $app;
  }

  /* Olivier */

  /**
   * Insert a category.
   */
  public function insertCategory() {
    /* @var $user User */
    $user = $this->getUser();
    if (isset($user) && ($user->isAdmin() )) {
      try {
        $category = $this->catsrv->addCategory();
        if ($category) {
          echo '{"name":"' . $category->getCategory() . '","id":"' . $category->getId() . '"}';
        }
        else {
          $errors = $this->catsrv->getErrors();
        }
      } catch (Exception $ex) {
        $this->getApp()->render('probleem.twig.html');
      }
    }
    else {
      $app->flash('error', 'Access denied');
      $this->app->redirectTo('main_page');
    }
  }

  /**
   * Update a category.
   */
  public function updateCategory($id) {
    try {
      $category_old = $this->catsrv->retrieveCategoryById($id);
      $category = $this->catsrv->updateCategory($category_old);
      if ($category) {
        echo '{"name":"' . $category->getCategory() . '"}';
      }
      else {
        $errors = $this->catsrv->getErrors();
        $globals = $this->getGlobals();
      }
    } catch (Exception $ex) {
      
    }
  }

  public function deleteCategory($id) {
    try {
      $category_old = $this->catsrv->retrieveCategoryById($id);
      $category = $this->catsrv->deleteCategory($category_old);
      if ($category) {
        //$app = $this->getApp();
        //$app->flash('info', 'Category ' . $category->getCategory() . ' updated.');
        //$app->redirect($app->urlFor('main_page'));
        echo '{"name":"' . $category->getCategory() . '"}';
      }
      else {
        $errors = $this->catsrv->getErrors();
        $globals = $this->getGlobals();
      }
    } catch (Exception $ex) {
      
    }
  }

  /* Olivier */

  public function getCategory() {

    try {
      $globals = $this->getGlobals();
      $categories = $this->catsrv->ShowAllCurrentCategory($this->em, $this->app);
      if ($categories) {
        $this->getApp()->render('Category/show_category_list.html.twig', array('globals' => $globals, 'categories' => $categories));
      }
      else {
        $errors = $this->catsrv->getErrors();
        $app = $this->getApp();
        $app->flash('error', 'No categories');
        $this->getApp()->render('Category/show_category_list.html.twig', array('globals' => $globals, 'errors' => $errors, 'categories' => $categories));
      }
    } catch (Exception $ex) {
      $this->getApp()->render('probleem.twig.html');
    }
  }

  public function show_category_by_id($id) {
    try {

      $globals = $this->getGlobals();
      $category = $this->catsrv->retrieveCategoryById($id);

      if ($category) {
        $this->getApp()->render('Category/show_category_by_id.html.twig', array('globals' => $globals, 'category' => $category));
      }
      else {
        $app = $this->getApp();
        $app->flash('error', 'The requested category does not exist');
        $app->redirectTo('error_404');
      }
    } catch (Exception $ex) {
      $this->getApp()->render('probleem.twig.html');
    }
  }

  public function getCategories() {
    /* @var $user User */
    $user = $this->getUser();

    if (isset($user) && ($user->isAdmin() || $user->canCreateCategory())) {
      try {
        $globals = $this->getGlobals();
        $categories = $this->catsrv->ShowAllCurrentCategories($this->em, $this->app);
        if ($categories) {
          $this->getApp()->render('Category/show_categories_list.html.twig', array('globals' => $globals, 'categories' => $categories));
        }
        else {
          $errors = $this->catsrv->getErrors();
          $app = $this->getApp();
          $app->flash('error', 'No categories');
          $this->getApp()->render('Category/show_categories_list.html.twig', array('globals' => $globals, 'errors' => $errors, 'categories' => $categories));
        }
      } catch (Exception $ex) {
        $this->getApp()->render('probleem.twig.html');
      }
    }
    else {
      $this->app->flash('error', 'Access denied.');
      $this->app->redirectTo('main_page');
    }
  }

  /* End Olivier    */
}
