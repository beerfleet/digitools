<?php

namespace scrum\ScotchLodge\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Barrel entity
 *
 * @author joeri broos
 */
class Barrel {

    private $id;
    private $casktype;
    private $whiskies;
    
    function __construct() {
        $this->whiskies = new ArrayCollection();
    }
    
    function getId(){
        return $this->id;
    }
    
    function getCasktype(){
        return $this->casktype;
    }
    
    function getWhiskies() {
        return $this->whiskies;
    }

    function setId($id){
        $this->id = $id;
    }
    
    function setCasktype($casktype){
        $this->casktype = $casktype;
    }

    function setWhiskies($whiskies) {
        $this->whiskies = $whiskies;
    }

}