<?php

namespace scrum\ScotchLodge\Entities;

/**
 * Description of WhiskyLike
 *
 * @author jan.vanbiervliet
 */
class WhiskyLike {

  const LIKED = 1;
  const DISLIKED = -1;
  const CLEAR = 0;
  
  private $id;
  private $whisky;
  private $user;
  private $state;     

  function __construct() {
    $this->state = 0;
  }

  function getId() {
    return $this->id;
  }

  function getWhisky() {
    return $this->whisky;
  }

  function getUser() {
    return $this->user;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setWhisky($whisky) {
    $this->whisky = $whisky;
  }

  function setUser($user) {
    $this->user = $user;
  }

  function getState() {
    return $this->state;
  }

  function setState($state) {
    $this->state = $state;
  }
  
  function setLike() {
    $this->state = 1;
  }
  
  function setDislike() {
    $this->state = -1;
  }
  
  function setClearState() {
    $this->state = 0;
  }

}
