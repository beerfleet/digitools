<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\Whisky;
use scrum\ScotchLodge\Entities\Event;

/**
 * EventWhisky entity
 *
 * @author joeri broos
 */
class EventWhisky {

    private $id;
    /* @var $event Event */
    private $event;
    /* @var $whisky Whisky */
    private $whisky;
    
    function getId(){
        return $this->id;
    }
    
    function getEvent(){
        return $this->event;
    }
    
    function getWhisky(){
        return $this->whisky;
    }
    
    function setId($id){
        $this->id = $id;
    }
    
    function setEvent(Event $event){
        $this->event = $event;
    }
    
    function setWhisky(Whisky $whisky){
        $this->whisky = $whisky;
    }
    
}