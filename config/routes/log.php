<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

$app->get('/log/new', function() use ($contr){
  $contr->new_log_entry();
})->name('new_log_entry');

$app->post('/log/new/', function() use ($contr){
  $contr->process_new_entry();
});