<?php

use Yahtzee\Controllers\TestController;

/* TESTING */
$test = new TestController($em, $app);

$app->get('/yahtzee/test/roll/die', function() use ($test) {
  $test->roll_die();
})->name('yahtzee_test_roll_die');

$app->get('/yahtzee/test/roll/dice', function() use ($test) {
  $test->roll_dice();
})->name('yahtzee_test_roll_dice');

$app->get('/yahtzee/test/roll/dice/gui', function() use ($test) {
  $test->roll_dice_gui();
})->name('yahtzee_test_roll_dice_gui');

/* YAHTZEE */
use Yahtzee\Controllers\YahtzeeController;

$yahtzee = new Yahtzee\Controllers\YahtzeeController($em, $app);
$app->get('/yahtzee/roll', function() use ($yahtzee) {
  $yahtzee->first_roll();
})->name('yahtzee_first_roll');

$app->post('/yahtzee/roll', function() use ($yahtzee) {
  $yahtzee->subsequent_roll();
})->name('yahtzee_subsequent_roll');