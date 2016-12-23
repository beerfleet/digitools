<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

$app->get('/make_log', function() use ($contr){
  $contr->testMakeLog();
})->name('make_log');