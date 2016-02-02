<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\Category;
use scrum\ScotchLodge\Entities\Whisky;

/**
 * WhiskyScore entity
 *
 * @author joeri broos
 */
class WhiskyScore {
    
    private $id;
    /* @var $category Category */
    private $category;
    /* @var $whisky Whisky */
    private $whisky;
    private $score;
    
    function getId(){
        return $this->id;
    }
    
    function getCategory(){
        return $this->category;
    }
    
    function getWhisky(){
        return $this->whisky;
    }
    
    function getScore(){
        return $this->score;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setCategory(Category $category){
        $this->category = $category;
    }
    
    function setWhisky(Whisky $whisky){
        $this->whisky = $whisky;
    }
    
    function setScore($score){
        $this->score = $score;
    }
}