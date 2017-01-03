<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

/* logs */
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

$app->post('/log/tag', function() use ($contr) {
  $contr->show_logs_filter_by_tags();
})->name('logs_per_tags');


/* tags */
$app->post('/tags/add', function() use ($contr) {
  $contr->add_tag_if_new();
});

$app->get('/tag', function() use ($contr) {
  $contr->manage_tags();
})->name('tags_manage');

$app->post('/tags/edit', function() use ($contr) {
  $contr->store_tag_status();
});

$app->post('/tag/search', function() use ($contr) {
  $contr->find_tag_by_desc();
});