<?php

namespace scrum\ScotchLodge\Entities;

use scrum\ScotchLodge\Entities\Distillery;
use scrum\ScotchLodge\Entities\Barrel;
use scrum\ScotchLodge\Entities\Region;
use scrum\ScotchLodge\Entities\User;
use scrum\ScotchLodge\Entities\Blend;
use scrum\ScotchLodge\Entities\Country;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Whisky entity
 *
 * @author joeri broos
 */
class Whisky {

  private $id;
  private $name;
  private $image_path;
  /* @var $region Region */
  private $region;
  /* @var $distillery Distillery */
  private $distillery;
  /* @var $bottlery Distillery */
  private $bottlery;
  private $price;
  private $age;
  private $alcohol;
  /* @var $barrel Barrel */
  private $barrel;
  private $view_count;
  private $short_description;
  private $review_date;
  /* @var $blend Blend */
  private $blend;
  private $date_distilled;
  private $date_bottled;
  /* @var $country Country */
  private $country;
  private $capacity;
  private $scores;
  private $comments;
  private $event_whisky;
  private $events;
  private $likes;
  private $created_by;

  function __construct() {
    $this->scores = new ArrayCollection();
    $this->comments = new ArrayCollection();
    $this->events = new ArrayCollection();
    $this->likes = new ArrayCollection();
  }

  function getBlend() {
      return $this->blend;
  }
  
  function getDateDistilled(){
      return $this->date_distilled;
  }

  function getDate_distilled() {
      return $this->date_distilled;
  }

  function getDateBottled(){
      return $this->date_bottled;
  }
  function getDate_bottled() {
      return $this->date_bottled;
  }

  function getCountry() {
      return $this->country;
  }

  function getCapacity() {
      return $this->capacity;
  }

  function setBlend($blend) {
      $this->blend = $blend;
  }
  
  function setDateDistilled($date_distilled){
    $this->date_distilled = $date_distilled;
  }

  function setDate_distilled($date_distilled) {
      $this->date_distilled = $date_distilled;
  }
  
  function setDateBottled($date_bottled){
      $this->date_bottled = $date_bottled;
  }

  function setDate_bottled($date_bottled) {
      $this->date_bottled = $date_bottled;
  }

  function setCountry($country) {
      $this->country = $country;
  }

  function setCapacity($capacity) {
      $this->capacity = $capacity;
  }

  function getEvents() {
    return $this->events;
  }

  function setEvents($events) {
    $this->events = $events;
  }

  function getEventWhisky() {
    return $this->event_whisky;
  }

  function setEventWhisky($event_whisky) {
    $this->event_whisky = $event_whisky;
  }

  function getComments() {
    return $this->comments;
  }

  function setComments($comments) {
    $this->comments = $comments;
  }

  function getScores() {
    return $this->scores;
  }

  function setScores($scores) {
    $this->scores = $scores;
  }

  function getId() {
    return $this->id;
  }

  function getName() {
    return $this->name;
  }

  function getImagePath() {
    return $this->image_path;
  }

  function getRegion() {
    return $this->region;
  }

  function getDistillery() {
    return $this->distillery;
  }

  function getBottlery() {
    return $this->bottlery;
  }

  function getPrice() {
    return $this->price;
  }

  function getAge() {
    return $this->age;
  }

  function getAlcohol() {
    return $this->alcohol;
  }

  function getBarrel() {
    return $this->barrel;
  }

  function getViewCount() {
    return $this->view_count;
  }

  function getShortDescription() {
    return $this->short_description;
  }

  function getShort_description() {
    return $this->short_description;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setName($name) {
    $this->name = $name;
  }

  function setImagePath($image_path) {
    $this->image_path = $image_path;
  }

  function setRegion(Region $region) {
    $this->region = $region;
  }

  function setDistillery(Distillery $distillery) {
    $this->distillery = $distillery;
  }

  function setPrice($price) {
    $this->price = $price;
  }

  function setAge($age) {
    $this->age = $age;
  }

  function setAlcohol($alcohol) {
    $this->alcohol = $alcohol;
  }

  function setBarrel(Barrel $barrel) {
    $this->barrel = $barrel;
  }

  function setViewCount($view_count) {
    $this->view_count = $view_count;
  }

  function setView_count($view_count) {
    $this->view_count = $view_count;
  }

  function setShortDescription($short_description) {
    $this->short_description = $short_description;
  }

  function setShort_description($short_description) {
    $this->short_description = $short_description;
  }

  function setBottlery(Distillery $bottlery) {
    $this->bottlery = $bottlery;
  }

  function setReviewDate($review_date) {
    $this->review_date = $review_date;
  }

  function getLikes() {
    return $this->likes;
  }

  function setLikes($likes) {
    $this->likes = $likes;
  }

  function getView_count() {
    return $this->view_count;
  }

  function getReview_date() {
    return $this->review_date;
  }

  function setReview_date($review_date) {
    $this->review_date = $review_date;
  }

  function getReviewDate() {
    return $this->review_date;
  }

  function getCreated_by() {
      return $this->created_by;
  }

  function setCreated_by(User $created_by) {
      $this->created_by = $created_by;
  }
  
  /* @return User*/
  function getCreatedBy() {
    return $this->created_by;
}

  function setCreatedBy(User $created_by) {
    $this->created_by = $created_by;
  }

}
