<?php

namespace scrum\ScotchLodge\Controllers;

use scrum\ScotchLodge\Controllers\Controller;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository;

/**
 * CountryController controller
 *
 * @author jan van biervliet
 */
class CountryController extends Controller {
  
  private $repo;
  
  function __construct($em, $app) {
    parent::__construct($em, $app);
        
    $this->repo = $em->getRepository('scrum\ScotchLodge\Entities\Country');
  }
  
  public function getAllCountries() {        
    $countries = $this->repo->findAll();
    return $countries;
  }
  
  public function getCountry ($id) {
    $country = $this->repo->find($id);
    return $country;
  }
}
