<?php

use Digitools\Logbook\Controllers\LogController;

$contr = new LogController($em, $app);

/* LOGS */
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

$app->get('/logs/manage', function() use ($contr) {
  $contr->admin_logs_manage();
})->name('admin_logs_manage');

$app->post('/log/mark-for-deletion', function() use ($contr) {
  $contr->log_toggle_deletion_request();
});

/* ajax */
$app->post('/admin/delete-marked-logs', function() use ($contr) {
  $contr->admin_delete_marked_logs();
});
$app->post('/images/fetch', function() use ($contr) {
  $contr->ajax_fetch_images();
});


/* TAGS */
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

$app->post('/tags/delete', function() use ($contr) {
  $contr->delete_tags();
});