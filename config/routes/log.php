<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

$app->get('/make_log', function() use ($contr){
  echo("ROUTE MAKE_LOG WORKS");
})->name('make_log');