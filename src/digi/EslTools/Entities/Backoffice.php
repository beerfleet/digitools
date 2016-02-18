<?php

namespace digi\eslTools\Entities;

use Doctrine\Common\Collections\ArrayCollection;

class Backoffice {
  private $id;
  private $backofficename;
  private $stores;

  function __construct() {
    $this->stores = new ArrayCollection();
  }

  // getters
  function getId() {
    return $this->getId();
  }

  function getBackofficename() {
    return $this->backofficename;
  }

  function getStores() {
    return $this->stores;
  }

  // setters
  function setId($id) {
    $this->id = $id;
  }

  function setBackofficeName($backofficename) {
    $this->backofficename = $backofficename;
  }

  function setStores(ArrayCollection $stores) {
    $this->stores = $stores;
  }
}