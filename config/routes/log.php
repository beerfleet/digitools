<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

$app->get('/make_log', function() use ($contr){
  $contr->show_log_form();
})->name('make_log');