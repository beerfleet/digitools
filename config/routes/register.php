<?php

use scrum\ScotchLodge\Controllers\RegistrationController;

$contr = new RegistrationController($em, $app);

$app->get('/register', function() use ($contr) {
  $contr->register();
})->name('user_register');

$app->post('/register', function() use ($contr) {
  $contr->processRegistration();
})->name('user_register_process');

$app->get('/register/ok', function() use ($contr) {
  $contr->registrationConfirm();
})->name('user_register_ok');

