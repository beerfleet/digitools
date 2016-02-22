<?php

use digi\eslTools\Controllers\EslController;

$contr = new EslController($em, $app);

$app->get('/esl', function() use ($contr) {
  $contr->esl_home();
})->name('esl_main');

// toon klanten
$app->get('/esl/klanten', function() use ($contr) {
  $contr->esl_sheet_show();
})->name('esl_sheet_show');

// nieuwe klant
$app->get('/esl/klant/nieuw', function() use ($contr) {
  $contr->esl_sheet_new();
})->name('esl_sheet_new');

$app->post('/esl/klant/nieuw', function() use ($contr) {
  $contr->esl_sheet_new_store();
})->name('esl_sheet_new_store');