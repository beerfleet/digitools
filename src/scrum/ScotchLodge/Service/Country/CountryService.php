<?php

namespace scrum\ScotchLodge\Service\Country;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Country;

/**
 * CountryService
 *
 * @author joeri broos
 */

class CountryService{
    
    private $em;
    private $app;
    private $errors;
    private $entity;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
      $this->entity = "scrum\ScotchLodge\Entities\Country";
    }

    public function getErrors(){
        return $this->errors;
    }
    
    public function getCountries(){
        $countries = $this->em->getRepository($this->entity)->findAll();
        if(count($countries)> 0){
            return $countries;
        }else{
            return null;
        }
    }
    
    public function getCountryObject($country_id){
        $country = $this->em->getRepository($this->entity)->find($country_id);
        if(count($country)> 0){
            return $country;
        }else{
            return null;
        }
    }
    
}