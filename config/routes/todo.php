<?php

use digi\eslTools\Controllers\TodoController;

$contr = new TodoController($em, $app);

$app->get('/todo', function() use ($contr) {
  $contr->todo_home();
})->name('todo_home');