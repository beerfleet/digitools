<?php

use scrum\ScotchLodge\Controllers\MemberController;

$contr = new MemberController($em, $app);

$app->get('/members', function() use ($contr) {
  $contr->member();
})->name('member_list');