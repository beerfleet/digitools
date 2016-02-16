<?php

namespace scrum\ScotchLodge\Service\Distillery;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Distillery;

/**
 * DistilleryService
 *
 * @author joeri broos
 */

class DistilleryService{
    
    private $em;
    private $app;
    private $errors;
    private $entity;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
      $this->entity = "scrum\ScotchLodge\Entities\Distillery";
    }

    public function getErrors(){
        return $this->errors;
    }
    
    public function getDistillerys(){
        $distillerys = $this->em->getRepository($this->entity)->findAll();
        if(count($distillerys)> 0){
            return $distillerys;
        }else{
            return null;
        }
    }
    
    public function getDistilleryObject($distillery_id){
        $distillery = $this->em->getRepository($this->entity)->find($distillery_id);
        if(count($distillery)> 0){
            return $distillery;
        }else{
            return null;
        }
    }
    
}