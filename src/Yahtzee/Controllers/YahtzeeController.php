<?php

namespace Yahtzee\Controllers;

use Digitools\Common\Controllers\Controller;
use Doctrine\ORM\EntityManager;
use Yahtzee\Service\DiceService;
use Slim\Slim;
use Yahtzee\Entities\Dice;

/**
 * Description of TestController
 *
 * @author jan
 */
class YahtzeeController extends Controller {
  /* @var $srv DiceService */
  private $srv;
  /* @var $em EntityManager */
  private $em;
  /* @var $app Slim */
   
  
  public function __construct($em, $app) {
    parent::__construct($em, $app);    
    $this->srv = new DiceService();
  }  
  
  public function roll_die() {
    echo $this->srv->roll();
  }
  
  public function roll_dice() {
    $this->srv->roll_dice();    
  }
  
  public function first_roll() {
    $data = $this->srv->load_data();
    $this->getApp()->render('Yahtzee/test_view.html.twig', ['globals' => $this->getGlobals(), 'dice' => $data['dice'], 'score' => $data['score']]);
  }
  
  public function subsequent_roll() {
    $data = $this->srv->load_data_subsequent();    
    $this->getApp()->render('Yahtzee/test_view.html.twig', ['globals' => $this->getGlobals(), 'dice' => $data['dice']->get_dice(), 'score' => $data['score']]);
  }
}
