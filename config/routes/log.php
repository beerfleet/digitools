<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

$app->get('/log/new', function() use ($contr){
  $contr->new_log_entry();
})->name('log_new');

$app->post('/log/new/', function() use ($contr){
  $contr->process_new_entry();
});

$app->get('/log/edit/:id', function($id) use ($contr) {
  $contr->edit_entry($id);
})->name('log_edit');
