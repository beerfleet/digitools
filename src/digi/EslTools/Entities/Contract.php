<?php

namespace digi\eslTools\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contract entity
 *
 * @author jan van biervliet
 */
class Contract {
  private $id;
  private $company;
  private $stores;

  function __construct() {
    $this->stores = new ArrayCollection();
  }

  // getters
  function getId() {
    return $this->id;
  }

  function getCompany() {
    return $this->company;
  }

  function getStores() {
    return $this->stores;
  }

  // setters
  function setId($id) {
    $this->id = $id;
  }

  function setCompany($company) {
    $this->company = $company;
  }

  function setStores($stores) {
    $this->stores = $stores;
  }

}