<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Yahtzee\Entities;

use Yahtzee\Entities\YDie;

/**
 * Description of Dice
 *
 * @author jan
 */
class Dice {

  private $dice;
  //private $lock_die;

  public function __construct($dice = null) {
    if ($dice != null) {
      $this->dice = $dice;
      return;
    }
    
    for ($i = 0; $i < 5; $i++) {
      $this->dice[$i]['die'] = new YDie();
      $this->dice[$i]['lock'] = 0;
    }
    //var_dump($this->dice);
  }

  public function get_dice() {
    return $this->dice;
  }

  public function roll() {
    /* @var $die YDie */
    foreach ($this->dice as $die) {
      if ($die['lock'] == 0)
        $die['die']->roll();
    }
  }
  
  public function lock_die($die_index) {
    $this->dice[$die_index]['lock'] = 1;
  }
  
  public function unlock_die($die_index) {
    $this->dice[$die_index]['lock'] = 0;
  }

  /* for testing */

  public function display_results() {
    $result = "";
    foreach ($this->dice as $die) {
      /* @var $die_obj YDie */
      $die_obj = $die['die'];
      $result .= $die_obj->value() . " ";
    }
    echo $result;
  }

}
