<?php

use Digitools\Todo\Controllers\TodoController;

$contr = new TodoController($em, $app);

$app->get('/todo', function() use ($contr) {
  $contr->todo_home();
})->name('todo_home');

$app->get('/todo/new', function() use ($contr) {
  $contr->todo_new();
})->name('todo_new');

