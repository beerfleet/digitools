<?php

namespace scrum\ScotchLodge\Service\Region;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Region;

/**
 * RegionService
 *
 * @author joeri broos
 */

class RegionService{
    
    private $em;
    private $app;
    private $errors;
    private $entity;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
      $this->entity = "scrum\ScotchLodge\Entities\Region";
    }

    public function getErrors(){
        return $this->errors;
    }
    
    public function getRegions(){
        $regions = $this->em->getRepository($this->entity)->findAll();
        if(count($regions)> 0){
            return $regions;
        }else{
            return null;
        }
    }
    
    public function getRegionObject($region_id){
        $region = $this->em->getRepository($this->entity)->find($region_id);
        if(count($region)> 0){
            return $region;
        }else{
            return null;
        }
    }
    
}