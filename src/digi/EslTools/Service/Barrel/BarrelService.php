<?php

namespace scrum\ScotchLodge\Service\Barrel;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Barrel;

/**
 * BarrelService
 *
 * @author joeri broos
 */

class BarrelService{
    
    private $em;
    private $app;
    private $errors;
    private $entity;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
      $this->entity = "scrum\ScotchLodge\Entities\Barrel";
    }

    public function getErrors(){
        return $this->errors;
    }
    
    public function getBarrels(){
        $barrels = $this->em->getRepository($this->entity)->findAll();
        if(count($barrels)> 0){
            return $barrels;
        }else{
            return null;
        }
    }
    
    public function getBarrelObject($barrel_id){
        $barrel = $this->em->getRepository($this->entity)->find($barrel_id);
        if(count($barrel)> 0){
            return $barrel;
        }else{
            return null;
        }
    }
    
}