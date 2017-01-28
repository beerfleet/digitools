<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Yahtzee\Entities;

/**
 * Description of YDie
 *
 * @author jan
 */
class YDie {
  
  private $eyes;
  
  public function __construct() {
    $this->eyes = 1;
  }
  
  public function roll() {
    $this->eyes = rand(1, 6);  
    return $this->eyes;
  }
  
  public function value() {
    return $this->eyes;
  }
  
}
