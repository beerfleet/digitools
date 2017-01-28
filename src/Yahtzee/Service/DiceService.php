<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Yahtzee\Service;

use Yahtzee\Entities\YDie;
use Yahtzee\Entities\Dice;
use Yahtzee\Entities\Session;

/**
 * Description of DiceService
 *
 * @author jan
 */
class DiceService {
  /* @var $die YDie */

  private $die;
  private $user;
  /* @var $em EntityManager */
  private $em;
  /* @var $app Slim */
  private $app;
  private $session;

  public function __construct($em = null, $app = null, $user = null) {
    $this->em = $em;
    /* @var $app Slim */
    $this->app = $app;
    $this->user = $user;
    $this->session = new Session();
  }

  public function roll() {
    $this->die = new YDie();
    $this->die->roll();
    return $this->die->value();
  }
  
  public function load_data_subsequent() {
    $data['dice'] = $this->roll_dice();
    $data['score'] = $this->load_score();
    return $data;
  }

  public function roll_dice() {
    $dice = new Dice($this->session->get_dice());
    $this->lock_dice($dice);
    $dice->roll();
    $this->session->set_dice($dice);
    return $dice;
    //$dice->display_results();
  }

  private function lock_dice(Dice $dice) {
    $app = $this->app;
    if (key_exists('lock_die1', $_POST)) {
      $dice->lock_die(0);
    } else {
      $dice->unlock_die(0);
    }
    if (key_exists('lock_die2', $_POST)) {
      $dice->lock_die(1);
    } else {
      $dice->unlock_die(1);
    }
    if (key_exists('lock_die3', $_POST)) {
      $dice->lock_die(2);
    } else {
      $dice->unlock_die(2);
    }
    if (key_exists('lock_die4', $_POST)) {
      $dice->lock_die(3);
    } else {
      $dice->unlock_die(3);
    }
    if (key_exists('lock_die5', $_POST)) {
      $dice->lock_die(4);
    } else {
      $dice->unlock_die(4);
    }
  }
  
  public function load_data() {
    $data['dice'] = $this->load_dice();
    $data['score'] = $this->load_score();    
    return $data;
  }
  
  public function load_score() {
    return $this->session->get_score();
  }

  public function load_dice() {
    return $this->session->get_dice();
  }

}
