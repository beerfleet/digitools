<?php
/* Olivier */

use scrum\ScotchLodge\Controllers\CategoryController;

$contr = new CategoryController($em, $app);

$app->get('/categories', function() use ($contr) {
  $contr->getCategories();
})->name('show_category_list');

$app->post('/editcategory/:id', function($id) use ($contr) {
  $contr->updateCategory($id);
})->name('editcategory');

$app->post('/addcategory', function() use ($contr) {
  $contr->insertCategory();
})->name('addcategory');


$app->post('/deletecategory/:id', function($id) use ($contr) {
  $contr->deleteCategory($id);
})->name('deletecategory');

/* Olivier */