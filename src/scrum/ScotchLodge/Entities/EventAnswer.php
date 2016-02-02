<?php

namespace scrum\ScotchLodge\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of EventAnswer
 *
 * @author Jan.VanBiervliet
 */
class EventAnswer {

  private $id;
  private $answer;
  private $users_present;

  function __construct() {
    $this->users_present = new ArrayCollection();
  }
  
  function getId() {
    return $this->id;
  }

  function getAnswer() {
    return $this->answer;
  }
  
  function getUsersPresent(){
    return $this->users_present;
  }
  
  function getUsers_Present(){
    return $this->users_present;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setAnswer($answer) {
    $this->answer = $answer;
  }
  
  function setUsersPresent($users_present){
    $this->users_present = $users_present;
  }

  function setUsers_Present($users_present){
    $this->users_present = $users_present;
  }
  
}
