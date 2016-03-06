<?php

use DigiTools\eslTools\Controllers\RegistrationController;

$contr = new RegistrationController($em, $app);

$app->get('/registreer', function() use ($contr) {
  $contr->register();
})->name('user_register');

$app->post('/registreer', function() use ($contr) {
  $contr->processRegistration();
})->name('user_register_process');

$app->get('/registreer/ok', function() use ($contr) {
  $contr->registrationConfirm();
})->name('user_register_ok');

