<?php

use scrum\ScotchLodge\Controllers\HomepageController;

$contr = new HomepageController($em, $app);

$app->get('/', function() use ($contr) {  
  $contr->homepage();
})->name('main_page');

$app->get('/print_routes', function() use ($contr) {
  $contr->showRoutes();
})->name('print_routes');

$app->notFound(function() use ($contr) {
  $contr->notFound();
});

$app->get('/404', function() use ($contr) {
  $contr->notFound();
})->name('error_404');