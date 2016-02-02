<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\Whisky;
use scrum\ScotchLodge\Entities\Comment;

/**
 * CommentReview entity
 *
 * @author joeri broos
 */
class CommentReview {

    private $id;
    /* @var $whisky Whisky */
    private $whisky;
    /* @var $comment Comment */
    private $comment;
    
    function getId(){
        return $this->id;
    }
    
    function getWhisky(){
        return $this->whisky;
    }
    
    function getComment(){
        return $this->comment;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setWhisky(Whisky $whisky){
        $this->whisky = $whisky;
    }
    
    function setComment(Comment $comment){
        $this->comment = $comment;
    }
    
}
