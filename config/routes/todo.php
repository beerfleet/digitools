<?php

use Digitools\Todo\Controllers\TodoController;

$contr = new TodoController($em, $app);

$app->get('/todo', function() use ($contr) {
  $contr->todo_home();
})->name('todo_home');

$app->get('/todo/new', function() use ($contr) {
  $contr->todo_new();
})->name('todo_new');

$app->post('/todo/new', function() use ($contr) {
  $contr->todo_new_store();
})->name('todo_new_store');

$app->get('/todo/unfinished', function() use ($contr) {
  $contr->todos_show_unfinished();
})->name('todos_unfinished');

// ajax
$app->post('/todo/ajax/storestate', function() use ($contr) {
  $contr->ajax_set_todo_state();
})->name('ajax_set_todo_state');