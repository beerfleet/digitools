<?php

namespace scrum\ScotchLodge\Entities; 

use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Entities\Comment;

/**
 * CommentLike entity
 *
 * @author joeri broos
 */
class CommentLike {

  const LIKED = 1;
  const DISLIKED = -1;
  const CLEAR = 0;
    
    private $id;
    /* @var $user User */
    private $user;
    /* @var $comment Comment */
    private $comment;
    private $state; 
    
    function getId(){
        return $this->id;
    }
    
    function getUser(){
        return $this->user;
    }
    
    function getComment(){
        return $this->comment;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setUser(User $user){
        $this->user = $user;
    }
    
    function setComment(Comment $comment){
        $this->comment = $comment;
    }
    
    
    function getState() {
        return $this->state;
    }

    function setState($state) {
        $this->state = $state;
    }

}