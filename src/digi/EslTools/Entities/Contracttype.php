<?php

namespace digi\eslTools\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contract entity
 *
 * @author jan van biervliet
 */
class Contracttype {
  private $id;
  private $typename;
  private $stores;

  function __construct() {
    $this->stores = new ArrayCollection();
  }

  // getters
  function getId() {
    return $this->id;
  }

  function getTypename() {
    return $this->typename;
  }

  function getStores() {
    return $this->stores;
  }

  // setters
  function setId($id) {
    $this->id = $id;
  }

  function setTypename($typename) {
    $this->typename = $typename;
  }

  function setStores($stores) {
    $this->stores = $stores;
  }

}