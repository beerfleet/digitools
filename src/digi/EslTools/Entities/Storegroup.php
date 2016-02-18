<?php

namespace digi\eslTools\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
* Storegroup entity
*
* @author Jan Van Biervliet
*/
class Storegroup {  
  private $id;  
  private $groupname;
  private $stores;

  function __construct() {
    $this->stores = new ArrayCollection();
  }

  // getters
  public function getId() {
    return $this->id;
  }

  public function getGroupname() {
    return $this->groupname;
  }

  public function getStores() {
    return $this->stores;
  }

  // setters
  public function setId($id) {
    $this->id = $id;
  }

  public function setGroupname($groupname) {
    $this->groupname = $groupname;
  }

  public function setStores(ArrayCollection $stores) {
    $this->stores = $stores;
  }
}