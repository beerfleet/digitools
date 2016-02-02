<?php

use scrum\ScotchLodge\Controllers\WhiskyController;

$contr = new WhiskyController($em, $app);

$app->get('/whisky/new', function() use ($contr){
    $contr->addWhisky();
})->name('new_whisky');

$app->post('/whisky/new', function() use ($contr){
    $contr->insertWhisky();
})->name('new_whisky_process');

$app->get('/whisky/edit/:id', function($id) use ($contr){
    $contr->editWhisky($id);
})->name('edit_whisky');

$app->post('/whisky/edit/:id', function($id) use ($contr){
    $contr->updateWhisky($id);
})->name('edit_whisky_process');

$app->post('/whisky/addcomment/:whisky_id', function($whisky_id) use ($contr) {
  $contr->ajax_addComment($whisky_id);
})->name('ajax_add_comment');

/* Olivier */

$app->get('/whisky/search', function() use ($contr){
    $contr->advanced_search_whisky();
})->name('advanced_search_whisky');


$app->post('/whisky/search', function() use ($contr){
    $contr->advanced_search_whisky_result();
})->name('advanced_search_whisky_result');

$app->get('/whisky/:id', function($id) use ($contr){
    $contr->show_whisky_by_id($id);
})->name('show_whisky_by_id');









/* Olivier */