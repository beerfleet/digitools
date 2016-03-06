<?php

namespace digi\Todo\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Postcode entity
 *
 * @author jan van biervliet
 */
class Priority {

  private $id;
  private $priorityvalue;
  private $description;

  function __construct() {
    $this->users = new ArrayCollection();
  }

  function getId() {
    return $this->id;
  }

  function setId($id) {
    $this->id = $id;
  }

  function getPriorityvalue() {
    return $this->priorityvalue;
  }

  function getDescription() {
    return $this->description;
  }

  function setPriorityvalue($priorityvalue) {
    $this->priorityvalue = $priorityvalue;
  }

  function setDescription($description) {
    $this->description = $description;
  }
  
  public function __toString() {
    return $this->description;
  }

}
