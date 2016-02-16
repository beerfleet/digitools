<?php

namespace scrum\ScotchLodge\Service\Blend;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Blend;

/**
 * BlendService
 *
 * @author joeri broos
 */

class BlendService{
    
    private $em;
    private $app;
    private $errors;
    private $entity;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
      $this->entity = "scrum\ScotchLodge\Entities\Blend";
    }

    public function getErrors(){
        return $this->errors;
    }
    
    public function getBlends(){
        $blends = $this->em->getRepository($this->entity)->findAll();
        if(count($blends)> 0){
            return $blends;
        }else{
            return null;
        }
    }
    
    public function getBlendObject($blend_id){
        $blend = $this->em->getRepository($this->entity)->find($blend_id);
        if(count($blend)> 0){
            return $blend;
        }else{
            return null;
        }
    }
    
}