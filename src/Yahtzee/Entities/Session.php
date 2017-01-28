<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Yahtzee\Entities;

use Yahtzee\Entities\Dice;

/**
 * Description of Session
 *
 * @author jan
 */
class Session {

  public function set_dice(Dice $dice) {
    $_SESSION['dice'] = $dice->get_dice();
  }

  public function get_dice() {
    return array_key_exists('dice', $_SESSION) ? $_SESSION['dice'] : null;
  }

  public function reset_score() {
    return [
        'ones' => null,
        'twos' => null,
        'threes' => null,
        'fours' => null,
        'fives' => null,
        'sixes' => null,
        'sub_top' => null,
        'bonus_top' => null,
        'total_top' => null,
        'toak' => null,
        'carre' => null,
        'full_house' => null,
        'small_straight' => null,
        'large_straight' => null,
        'yahtzee' => null,
        'chance' => null,
        'total_bottom' => null,        
        'total' => null,
    ];
  }

  public function get_score() {
    if (!array_key_exists('score', $_SESSION)) {
      $_SESSION['score'] = $this->reset_score();
    }
    return $_SESSION['score'];
  }

}
