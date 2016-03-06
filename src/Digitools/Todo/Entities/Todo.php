<?php

namespace Digitools\Todo\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use digi\Todo\Entities\Priority;

/**
 * Postcode entity
 *
 * @author jan van biervliet
 */
class Todo {

  private $id;
  private $title;
  private $creationdate;

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
    return $this->creationdate;
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

}
