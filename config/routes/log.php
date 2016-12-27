<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

$app->get('/log', function() use ($contr) {
  $contr->new_log_entry();
})->name('log_new');

$app->post('/log', function() use ($contr) {
  $contr->process_new_entry();
});

$app->get('/log/edit/:id', function($id) use ($contr) {
  $contr->edit_entry($id);
})->name('log_edit');

$app->post('/log/edit/:id', function($id) use ($contr) {
  $contr->process_modified_entry($id);
})->name('log_edit_store');

$app->post('/tags/add', function() use ($contr) {
  $contr->add_tag_if_new();
});
