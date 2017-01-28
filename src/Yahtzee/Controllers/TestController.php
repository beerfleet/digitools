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
class TestController extends Controller {
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
  
  public function roll_dice_gui() {
    $dice = $this->srv->roll_dice();    
    $this->getApp()->render('Yahtzee/test_view.html.twig', ['globals' => $this->getGlobals(), 'dice' => null]);
  }
}
