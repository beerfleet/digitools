<?php

use digi\eslTools\Controllers\EslController;

$contr = new EslController($em, $app);

$app->get('/esl', function() use ($contr) {
  $contr->esl_home();
})->name('esl_main');