<?php

namespace digi\eslTools\Entities;

use digi\eslTools\Entities\Storegroup;
use digi\eslTools\Entities\Postcode;
use digi\eslTools\Entities\Contract;
use digi\eslTools\Entities\Contracttype;
use digi\eslTools\Entities\Backoffice;

/**
* Store entity
*
* @author Jan Van Biervliet
*/
class Store {
  private $id;
  private $storename;
  private $synergie;
  private $ip;
  private $softwareversion;
  private $contact;
  private $email;

  /* @var $storegroup Storegroup */
  private $storegroup;

  /* @var $postcode Postcode */
  private $postcode;

  /* @var $contract Contract */
  private $contract;

  /* @var $contract Contracttype */
  private $contracttype;

  /* @var $backoffice Backoffice */
  private $backoffice;

  // getters
  public function getId() {
    return $this->id;
  }

  public function getStorename() {
    return $this->storename;
  }

  public function getSynergie() {
    return $this->synergie;
  }

  public function getIp() {
    return $this->ip;
  }

  public function getSoftwareversion() {
    return $this->softwareversion;
  }

  public function getContact() {
    return $this->contact;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getStoregroup() {
    return $this->storegroup;
  }

  public function getPostcode() {
    return $this->postcode;
  }

  public function getContract() {
    return $this->contact;
  }

  public function getContracttype() {
    return $this->contracttype;
  }

  public function getBackoffice() {
    return $this->backoffice;
  }

  // setters
  public function setId($id) {
    $this->id = $id;
  }

  public function setStorename($storename) {
    $this->storename = $storename;
  }

  public function setSynergie($synergie) {
    $this->synergie = $synergie;
  }

  public function setIp($ip) {
    $this->ip = $ip;
  }

  public function setSoftwareversion($softwareversion) {
    $this->softwareversion = $softwareversion;
  }

  public function setContact($contact) {
    $this->contact = $contact;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setStoregroup(Storegroup $storegroup) {
    $this->storegroup = $storegroup;
  }

  public function setPostcode(Postcode $postcode) {
    $this->postcode = $postcode;
  }

  public function setContract(Contract $contract) {
    $this->contract = $contract;
  }

  public function setContracttype(Contracttype $contracttype) {
    $this->contracttype = $contracttype;
  }

  public function setBackoffice(Backoffice $backoffice) {
    $this->backoffice = $backoffice;
  }
}