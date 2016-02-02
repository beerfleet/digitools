<?php

namespace scrum\ScotchLodge\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category entity
 *
 * @author joeri broos
 */
class Category {
    
    private $id;
    private $category;
    private $scores;
    
    function __construct() {
        $this->scores = new ArrayCollection();
    }
    
    function getId(){
        return $this->id;
    }
    
    function getCategory(){
        return $this->category;
    }
    
    function getScores(){
        return $this->scores;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setCategory($category){
        $this->category = $category;
    }
    
    function setScores($scores){
        $this->scores = $scores;
    }
    
}