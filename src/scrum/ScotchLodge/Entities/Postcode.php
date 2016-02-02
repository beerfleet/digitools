<?php

namespace scrum\ScotchLodge\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Postcode entity
 *
 * @author jan van biervliet
 */
class Postcode {

  private $id;
  private $postcode;
  private $town;
  private $users;
  private $events;

  function __construct($users) {
    $this->users = new ArrayCollection();
    $this->events = new ArrayCollection();
  }

  function getId() {
    return $this->id;
  }

  function getPostcode() {
    return $this->postcode;
  }

  function getTown() {
    return $this->town;
  }

  function getUsers() {
    return $this->users;
  }

  function getEvents() {
    return $this->events;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setPostcode($postcode) {
    $this->postcode = $postcode;
  }

  function setTown($town) {
    $this->town = $town;
  }

  function setUsers($users) {
    $this->users = $users;
  }

  function setEvents($events) {
    $this->events = $events;
  }

}
