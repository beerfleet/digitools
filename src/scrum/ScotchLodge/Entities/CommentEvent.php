<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\Comment;
use scrum\ScotchLodge\Entities\Event;

/**
 * CommentEvent entity
 *
 * @author joeri broos
 */
class CommentEvent {

    private $id;
    /* @var $comment Comment */
    private $comment;
    /* @var $event Event */
    private $event;
    
    function getId(){
        return $this->id;
    }
    
    function getComment(){
        return $this->comment;
    }
    
    function getEvent(){
        return $this->event;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setComment(Comment $comment){
        $this->comment = $comment;
    }
    
    function setEvent(Event $event){
        $this->event = $event;
    }
    
}