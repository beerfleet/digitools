<?php

namespace scrum\ScotchLodge\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Country entity
 *
 * @author jan van biervliet
 */
class Country {

  private $id;
  private $country_code;
  private $country_name;
  private $regions;
  private $distilleries;
  private $whiskies;
  
  function __construct() {
      $this->regions = new ArrayCollection();
      $this->distilleries = new ArrayCollection();
      $this->whiskies = new ArrayCollection();
  }

  function getId() {
    return $this->id;
  }

  function getCountryCode(){
    return $this->country_code;
  }
  
  function getCountry_code() {
    return $this->country_code;
  }
  
  function getName(){
    return $this->country_name;
  }
  
  function getCountryName(){
    return $this->country_name;
  }

  function getCountry_name() {
    return $this->country_name;
  }

  function getRegions() {
      return $this->regions;
  }
  
  function getDistilleries(){
    return $this->distilleries;
  }
  
  function getWhiskies(){
    return $this->whiskies;
  }

  function setId($id) {
    $this->id = $id;
  }

  function setCountryCode($country_code){
    $this->country_code = $country_code;
  }
  
  function setCountry_code($country_code) {
    $this->country_code = $country_code;
  }

  function setCountryName($country_name){
    $this->country_name = $country_name;
  }
  
  function setCountry_name($country_name) {
    $this->country_name = $country_name;
  }
  
  function setRegions($regions) {
    $this->regions = $regions;
  }
  
  function setDistilleries($distilleries){
    $this->distilleries = $distilleries;
  }
  
  function setWhiskies($whiskies){
    $this->whiskies = $whiskies;
  }
  
}
