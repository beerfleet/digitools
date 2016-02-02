<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\Postcode;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User entity
 *
 * @author jan van biervliet
 */
class User {

  private $id;
  private $username;
  private $email;
  private $enabled;
  private $password;
  private $last_login;
  private $first_name;
  private $surname;
  /* @var $postcode Postcode */
  private $postcode;
  private $address;
  private $can_review;
  private $can_create_category;
  private $can_create_event;
  private $is_admin;
  private $password_token;
  private $is_deleted;
  private $user_likes;
  private $present_in_events;
  private $whisky_likes;
  private $comments;
  private $whiskys_created;
  private $events_created;

  function __construct() {
    $this->user_likes = new ArrayCollection();
    $this->comments = new ArrayCollection();
    $this->present_in_events = new ArrayCollection();
    $this->whisky_likes = new ArrayCollection();
    $this->whiskys_created = new ArrayCollection();
    $this->events_created = new ArrayCollection();
    
  }

  function getId() {
    return $this->id;
  }

  function getUsername() {
    return $this->username;
  }

  function getEmail() {
    return $this->email;
  }

  function isEnabled() {
    return $this->enabled == 1;
  }

  function getPassword() {
    return $this->password;
  }

  function getLastLogin() {
    return $this->last_login;
  }

  function getFirstName() {
    return $this->first_name;
  }

  function getSurname() {
    return $this->surname;
  }

  function getPostcode() {
    return $this->postcode;
  }

  function getAddress() {
    return $this->address;
  }

  function getPasswordToken() {
    return $this->password_token;
  }

  function canReview() {
    return $this->can_review == 1;
  }

  function canCreateCategory() {
    return $this->can_create_category == 1;
  }

  function canCreateEvent() {
    return $this->can_create_event == 1;
  }

  function isAdmin() {
    return $this->is_admin == 1;
  }
  
  function isDeleted(){
    return $this->is_deleted == 1;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setUsername($username) {
    $this->username = $username;
  }

  function setEmail($email) {
    $this->email = $email;
  }

  function setEnabled($enabled) {
    $this->enabled = $enabled;
  }

  function setPassword($password) {
    $this->password = $password;
  }

  function setLastLogin($last_login) {
    $this->last_login = $last_login;
  }

  function setFirstName($first_name) {
    $this->first_name = $first_name;
  }

  function setSurname($surname) {
    $this->surname = $surname;
  }

  function setPostcode(Postcode $postcode) {
    $this->postcode = $postcode;
  }

  function setAddress($address) {
    $this->address = $address;
  }

  function setCanReview($can_review) {
    $this->can_review = $can_review;
  }

  function setCanCreateCategory($can_create_category) {
    $this->can_create_category = $can_create_category;
  }

  function setCanCreateEvent($can_create_event) {
    $this->can_create_event = $can_create_event;
  }

  function setAdmin($is_admin) {
    $this->is_admin = $is_admin;
  }

  function resetPasswordToken() {
    $this->password_token = null;
  }

  function setPasswordToken() {
    $this->password_token = uniqid(mt_rand(), true);
  }
  
  function setDeleted($is_deleted){
    $this->is_deleted = $is_deleted;
  }

  function getUser_likes() {
    return $this->user_likes;
  }

  function setUser_likes($user_likes) {
    $this->user_likes = $user_likes;
  }

  function getComments() {
    return $this->comments;
  }

  function setComments($comments) {
    $this->comments = $comments;
  }

  function getPresent_in_events() {
    return $this->present_in_events;
  }

  function setPresent_in_events($present_in_events) {
    $this->present_in_events = $present_in_events;
  }

  function getWhiskyLikes() {
    return $this->whisky_likes;
  }

  function setWhiskyLikes($whisky_likes) {
    $this->whisky_likes = $whisky_likes;
  }
  
  function getWhiskysCreated() {
    return $this->whiskys_created;
  }

  function setWhiskysCreated($whiskys_created) {
    $this->whiskys_created = $whiskys_created;
  }
  
  function getWhiskys_created() {
    return $this->whiskys_created;
  }

  function setWhiskys_created($whiskys_created) {
    $this->whiskys_created = $whiskys_created;
  }
  
  function getEventsCreated() {
    return $this->events_created;
  }

  function setEventsCreated($events_created) {
    $this->events_created = $events_created;
  }
  
  function getEvents_created() {
    return $this->events_created;
  }

  function setEvents_created($events_created) {
    $this->events_created = $events_created;
  }
  
  function hasCommentsCreated() {
    return count($this->comments) > 0;
  }

  function hasEventsCreated() {
    return count($this->events_created) > 0;
  }
  
  function hasWhiskysCreated() {
    return count($this->whiskys_created) > 0;
  }
  

}