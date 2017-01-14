<?php

namespace Digitools\Todo\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Digitools\EslTools\Entities\User;

/**
 * Postcode entity
 *
 * @author jan van biervliet
 */
class Todo {

  private $id;
  private $title;
  private $finishstate;
  private $creationdate;
  private $tododate;
  private $finishdate;
  /* @var $user User */
  private $user;
  
  public function user_id() {
    return $user->getId();
  }

  function getUser() {
    return $this->user;
  }

  function setUser($user) {
    $this->user = $user;
  }

  /* @var $priority Priority */

  private $priority;

  function __construct() {
    $this->users = new ArrayCollection();
  }

  function getId() {
    return $this->id;
  }

  function setId($id) {
    $this->id = $id;
  }

  function getTitle() {
    return $this->title;
  }

  function getCreationdate() {
    return $this->creationdate == null ? "" : $this->creationdate->format('Y-m-d H:i');
  }

  function getPriority() {
    return $this->priority;
  }

  function setTitle($title) {
    $this->title = $title;
  }

  function setCreationdate(\DateTime $creationdate) {
    $this->creationdate = $creationdate;
  }

  function setPriority(Priority $priority) {
    $this->priority = $priority;
  }

  public function __toString() {
    return $this->title;
  }

  function getTododate() {
    return $this->tododate == null ? "" : $this->tododate->format('Y-m-d H:i');
  }

  function setTododate($tododate) {
    $this->tododate = $tododate;
  }

  function getFinishstate() {
    return $this->finishstate;
  }

  function setFinishstate($state) {
    $this->finishstate = $state;
    var_dump($this->creationdate);
  }

  function setFinishdate(\DateTime $finishdate) {
    $this->finishdate = $finishdate;
  }

  function getFinishdate() {
    return $this->finishdate->format('Y-m-d H:i');
  }

}
