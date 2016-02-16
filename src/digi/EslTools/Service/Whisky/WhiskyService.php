<?php

namespace scrum\ScotchLodge\Service\Whisky;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Whisky;
use scrum\ScotchLodge\Entities\Comment;
use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Entities\CommentReview;
use scrum\ScotchLodge\Entities\WhiskyScore;
use scrum\ScotchLodge\Service\Validation\WhiskyValidation as Val;
use scrum\ScotchLodge\Service\Region\RegionService;
use scrum\ScotchLodge\Service\Distillery\DistilleryService;
use scrum\ScotchLodge\Service\Barrel\BarrelService;
use scrum\ScotchLodge\Service\Blend\BlendService;
use scrum\ScotchLodge\Service\Country\CountryService;
use scrum\ScotchLodge\Service\Category\CategoryService;
use scrum\ScotchLodge\Service\Validation\WhiskySearchValidation;
use DateTime;

/**
 * WhiskyService
 *
 * @author joeri broos
 */
class WhiskyService {

  private $em;
  private $app;
  private $errors;
  private $entity;

  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    $this->errors = null;
    $this->entity = "scrum\ScotchLodge\Entities\Whisky";
  }

  public function getErrors() {
    return $this->errors;
  }

  /* Begin Add function */

  /**
   * Create a new whisky, returns a Whisky when there are no errors,
   * otherwhise it gives a false in return.
   * @return boolean|Whisky
   */
  public function addWhisky(User $user) {
    $val = new Val($this->app, $this->em);
    if ($val->validate()) {
      $name = $this->app->request->post('name');
      $image_path = $this->app->request->post('image_path');
      $region = $this->app->request->post('region');
      $distillery = $this->app->request->post('distillery');
      $bottlery = $this->app->request->post('bottlery');
      $price_input = $this->app->request->post('price');
      $price = $price_input * 100;
      $age = $this->app->request->post('age');
      $alcohol_input = $this->app->request->post('alcohol');
      $alcohol = $alcohol_input * 100;
      $barrel = $this->app->request->post('barrel');
      $description = $this->app->request->post('description');
      $blend = $this->app->request->post('blend');
      $distilled = $this->app->request->post('distilled');
      $date_dis = str_replace('/', '-', $distilled);
      $bottled = $this->app->request->post('bottled');
      $date_bot = str_replace('/', '-', $bottled);
      $country = $this->app->request->post('country');
      $cap = $this->app->request->post('capacity');




      $capacity = $cap * 100;

      /* @var $whisky Whisky */
      $whisky = new Whisky();
      $whisky->setName($name);
      $whisky->setImagePath($image_path);
      /* @var $region Region */
      $regsrv = new RegionService($this->em, $this->app);
      $region_object = $regsrv->getRegionObject($region);
      $whisky->setRegion($region_object);
      /* @var $distillery Distillery */
      $dissrv = new DistilleryService($this->em, $this->app);
      $distillery_object = $dissrv->getDistilleryObject($distillery);
      $whisky->setDistillery($distillery_object);
      /* @var $bottlery Distillery */
      $botsrv = new DistilleryService($this->em, $this->app);
      $bottlery_object = $botsrv->getDistilleryObject($bottlery);
      $whisky->setBottlery($bottlery_object);
      $whisky->setPrice($price);
      $whisky->setAge($age);
      $whisky->setAlcohol($alcohol);
      /* @var $barrel Barrel */
      $barsrv = new BarrelService($this->em, $this->app);
      $barrel_object = $barsrv->getBarrelObject($barrel);
      $whisky->setBarrel($barrel_object);
      $whisky->setShortDescription($description);
      $review_date = new DateTime('now');
      $whisky->setReviewDate($review_date);
      $whisky->setCreatedBy($user);
      /* @var $blend Blend */
      $blendsrv = new BlendService($this->em, $this->app);
      $blend_object = $blendsrv->getBlendObject($blend);
      $whisky->setBlend($blend_object);
      if ($date_dis != null) {
        $date_distilled = new \DateTime($date_dis);
        $whisky->setDateDistilled($date_distilled);
      }
      if ($date_bot != null) {
        $date_bottled = new \DateTime($date_bot);
        $whisky->setDateBottled($date_bottled);
      }
      /* @var $country Country */
      $countrysrv = new CountryService($this->em, $this->app);
      $country_object = $countrysrv->getCountryObject($country);
      $whisky->setCountry($country_object);
      $whisky->setCapacity($capacity);

      $this->em->persist($whisky);
      $this->em->flush();

      $tab = $this->app->request->post('catparam');

      for ($i = 0; $i < count($tab); $i++) {
        $categoryscore = new Whiskyscore();
        $cat = explode("|", $tab[$i]);
        $categoryscore->setScore($cat[1] * 100);
        $categorysrv = new CategoryService($this->em, $this->app);
        $category = $categorysrv->retrieveCategoryById($cat[0]);
        $categoryscore->setCategory($category);
        $categoryscore->setWhisky($whisky);
        $this->em->persist($categoryscore);
        $this->em->flush();
      }

      return $whisky;
    }
    $this->errors = $val->getErrors();
    return false;
  }

  /* End Add function */

  /* Begin Update function */

  /**
   * Update the fields of a whisky
   * @param Whisky $whisky
   */
  public function updateWhisky(Whisky $whisky) {

    $name = $this->app->request->post('name');
    if ($whisky->getName() != $name) {
      $whisky->setName($name);
    }

    /*
      $image_path = $this->app->request->post('image_path');
      if($whisky->getImagePath() != $image_path){
      $whisky->setImagePath($image_path);
      }
     */

    $region = $this->app->request->post('region');
    if ($whisky->getRegion()->getId() != $region) {
      $regsrv = new RegionService($this->em, $this->app);
      $region_object = $regsrv->getRegionObject($region);
      $whisky->setRegion($region_object);
    }

    $distillery = $this->app->request->post('distillery');
    if ($whisky->getDistillery() != null && $distillery != null) {
      if ($whisky->getDistillery()->getId() != $distillery) {
        $distsrv = new DistilleryService($this->em, $this->app);
        $distillery_object = $distsrv->getDistilleryObject($distillery);
        $whisky->setDistillery($distillery_object);
      }
    } else {
      $distsrv = new DistilleryService($this->em, $this->app);
      $distillery_object = $distsrv->getDistilleryObject($distillery);
      $whisky->setDistillery($distillery_object);
    }

    $bottlery = $this->app->request->post('bottlery');
    if ($whisky->getBottlery() != null && $bottlery != null) {
      if ($whisky->getBottlery()->getId() != $bottlery) {
        $botsrv = new DistilleryService($this->em, $this->app);
        $bottlery_object = $botsrv->getDistilleryObject($bottlery);
        $whisky->setBottlery($bottlery_object);
      }
    } else {
      $botsrv = new DistilleryService($this->em, $this->app);
      $bottlery_object = $botsrv->getDistilleryObject($bottlery);
      $whisky->setBottlery($bottlery_object);
    }

    $price_input = $this->app->request->post('price');
    $price = $price_input * 100;
    if ($whisky->getPrice() != $price) {
      $whisky->setPrice($price);
    }

    $age = $this->app->request->post('age');
    if ($whisky->getAge() != $age) {
      $whisky->setAge($age);
    }

    $alcohol_input = $this->app->request->post('alcohol');
    $alcohol = $alcohol_input * 100;
    if ($whisky->getAlcohol() != $alcohol) {
      $whisky->setAlcohol($alcohol);
    }

    $barrel = $this->app->request->post('barrel');
    if ($whisky->getBarrel()->getId() != $barrel) {
      $barsrv = new BarrelService($this->em, $this->app);
      $barrel_object = $barsrv->getBarrelObject($barrel);
      $whisky->setBarrel($barrel_object);
    }

    $description = $this->app->request->post('description');
    if ($whisky->getShortDescription() != $description) {
      $whisky->setShortDescription($description);
    }

    $blend = $this->app->request->post('blend');
    if ($whisky->getBlend()->getId() != $blend) {
      $blendsrv = new BlendService($this->em, $this->app);
      $blend_object = $blendsrv->getBlendObject($blend);
      $whisky->setBlend($blend_object);
    }

    $date_distilled_input = $this->app->request->post('distilled');
    if ($date_distilled_input != null && $whisky->getDateDistilled() != $date_distilled_input) {
      $date_distilled = new DateTime($date_distilled_input);
      $whisky->setDateDistilled($date_distilled);
    }

    $date_bottled_input = $this->app->request->post('bottled');
    if ($date_bottled_input != null && $whisky->getDateBottled() != $date_bottled_input) {
      $date_bottled = new DateTime($date_bottled_input);
      $whisky->setDateBottled($date_bottled);
    }

    $country = $this->app->request->post('country');
    if ($whisky->getCountry()->getId() != $country) {
      $countrysrv = new CountryService($this->em, $this->app);
      $country_object = $countrysrv->getCountryObject($country);
      $whisky->setCountry($country_object);
    }

    $capacity_input = $this->app->request->post('capacity');
    $capacity = $capacity_input * 100;
    if ($whisky->getCapacity() != $capacity) {
      $whisky->setCapacity($capacity);
    }

    $this->em->persist($whisky);
    $this->em->flush();


    $tab = $this->app->request->post('catparam');

    for ($i = 0; $i < count($tab); $i++) {

      $cat = explode("|", $tab[$i]);

      //$whiskyscore = new Whiskyscore;
      $whiskyscore = $this->em->find('scrum\ScotchLodge\Entities\WhiskyScore', $cat[2]);
      $whiskyscore->setScore($cat[1] * 100);
      $categorysrv = new CategoryService($this->em, $this->app);
      $category = $categorysrv->retrieveCategoryById($cat[0]);
      $whiskyscore->setCategory($category);
      $whiskyscore->setWhisky($whisky);
      $this->em->persist($whiskyscore);
      $this->em->flush();
    }


    return $whisky;
  }

  /* End Update function */

  /* Begin View Whisky function */

  /**
   * +1 to the view_count of Whisky. 
   * @param int $id
   */
  public function ViewWhisky(Whisky $whisky) {
    $views = $whisky->getViewCount();
    if (isset($views)) {
      $views++;
    } else {
      $views = 1;
    }
    $whisky->setViewCount($views);
    $this->em->persist($whisky);
    $this->em->flush();
    return $whisky;
  }

  /* End View Whisky function */

  /* Begin Search functions */

  /**
   * Retrieve a whisky by is Id
   * @param int $id
   * @return Whisky $whisky
   */
  public function retrieveWhiskyById($id) {
    $whisky = $this->em->getRepository($this->entity)->find($id);
    if (count($whisky) > 0) {
      return $whisky;
    } else {
      return null;
    }
  }

  public function latestReviews($limit = null) {
    $repo = $this->em->getRepository('scrum\ScotchLodge\Entities\Whisky');
    $latest = $repo->getLatestReviews($limit);
    return $latest;
  }

  public function popularReviews($limit = null) {
    $repo = $this->em->getRepository('scrum\ScotchLodge\Entities\Whisky');
    $popular = $repo->getPopularReviews($limit);
    return $popular;
  }

  public function retrieveReviews($limit) {
    $reviews['latest'] = $this->latestReviews($limit);
    $reviews['popular'] = $this->popularReviews($limit);
    return $reviews;
  }

  public function addWhiskyComment($whisky_id, $user, $message) {
    /* @var $em EntityManager */
    $em = $this->em;

    /* create comment */
    $comment = new Comment();
    $comment->setCommentDate(new \DateTime());
    $comment->setComment($message);
    $comment->setUser($user);
    $em->persist($comment);
    $em->flush();

    /* fetch whisky */
    $whisky = $em->getRepository($this->entity)->find($whisky_id);

    /* couple comment to whisky */
    $whisky_comment = new CommentReview();
    $whisky_comment->setWhisky($whisky);
    $whisky_comment->setComment($comment);
    $em->persist($whisky_comment);
    $em->flush();
  }

  /* Olivier whisky service */

  public function advanced_search_whisky_result() {

    if ($this->app->request->post('region') != null)
      $req["region"] = $this->app->request->post('region');

    if ($this->app->request->post('distillery') != null)
      $req["distillery"] = $this->app->request->post('distillery');

    if ($this->app->request->post('bottler') != null)
      $req["bottler"] = $this->app->request->post('bottler');

    if ($this->app->request->post('barrel') != null)
      $req["barrel"] = $this->app->request->post('barrel');

    if ($this->app->request->post('blend') != null)
      $req["blend"] = $this->app->request->post('blend');

    if ($this->app->request->post('name') != null)
      $req["name"] = $this->app->request->post('name');

    $val = new WhiskySearchValidation($this->app, $this->em);

    if ($val->validate()) {
      if (isset($req)) {
        $whisky_results = $this->em->getRepository($this->entity)->findFiltered($req);
        return $whisky_results;
      } else {
        $whisky = $this->em->getRepository($this->entity)->findall();
        return $whisky;
      }
    } else {
      /* @var $app Slim */
      $app = $this->app;
      $app->flash('errors', $val->getErrors());
      $app->redirectTo('advanced_search_whisky', $val->getErrors());      
    }
  }

  /* Olivier */
}
