<?php

use Digitools\EslTools\Controllers\ProfileController;

$contr = new ProfileController($em, $app);

$app->post('/login', function() use ($contr) {
  $contr->verifyUserCredentials();  
})->name('user_logon_process');

$app->get('/afmelden', function() use ($contr){
  $contr->logOff();
})->name('user_logoff');


$app->get('/profiel', function() use ($contr){
  $contr->showProfile();
})->name('profile_show');

$app->post('/profiel/wijzig', function() use ($contr) {
  $contr->editProfile();
})->name('profile_edit');

$app->post('/profile/edit/:id', function($id) use ($contr) {  
  $contr->admin_profile_edit($id);
})->name('admin_profile_edit');

$app->get('/profiel/id/:id', function($id) use ($contr) {
  $contr->showProfileOfUserWithId($id);
})->name('profile_show_by_id');

$app->get('/profiel/gebruiker/:username', function($username) use ($contr) {
  $contr->showProfileOfUserWithUsername($username);
})->name('/profile_show_by_username');

$app->get('/profielen', function() use ($contr) {
  $contr->showProfilesList();
})->name('admin_list_profiles');

$app->get('/profile/view/:id', function ($id) use ($contr) {
  $contr->view_profile_with_id($id);
})->name('admin_profile_view');


/* olivier */
$app->get('/editadmin/:username', function($username) use ($contr) {
  $contr->editProfileAdmin($username);
})->name('profile_editadmin');

$app->post('/profile/storeadmin', function() use ($contr){
  $contr->storeChangesAdmin();
})->name('profile_edit_save_admin');

/*olivier */
$app->post('/profiel/bewaar', function() use ($contr){
  $contr->profile_edit_store();
})->name('profile_edit_store');


$app->get('/wachtwoord/herstel', function() use ($contr) {
  $contr->passwordResetRequest();  
})->name('password_reset_request');

$app->post('/wachtwoord/herstel', function() use ($contr) {
  $contr->passwordResetProcess();
})->name('password_reset_process');

$app->get('/verifieer/:token', function($token) use ($contr) {
  $contr->processToken($token);
})->name('reset_token_verify');

$app->get('/activeer/:token', function($token) use ($contr) {
  $contr->processLogonToken($token);  
})->name('logon_token_verify');

$app->post('/wachtwoord/bewaar', function() use ($contr) {  
  $contr->processNewPassword();
})->name('verify_new_password');