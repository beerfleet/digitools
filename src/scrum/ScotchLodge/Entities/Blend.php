<?php

namespace scrum\ScotchLodge\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Barrel entity
 *
 * @author joeri broos
 */
class Blend {

    private $id;
    private $blend;
    private $whiskies;
    
    function __construct() {
        $this->whiskies = new ArrayCollection();
    }
    
    function getId(){
        return $this->id;
    }
    
    function getBlend(){
        return $this->blend;
    }
    
    function getWhiskies() {
        return $this->whiskies;
    }

    function setId($id){
        $this->id = $id;
    }
    
    function setBlend($blend){
        $this->blend = $blend;
    }

    function setWhiskies($whiskies) {
        $this->whiskies = $whiskies;
    }

}