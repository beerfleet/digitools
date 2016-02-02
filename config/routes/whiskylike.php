<?php
/* olivier */

use scrum\ScotchLodge\Controllers\WhiskyLikeController;

$contr = new WhiskyLikeController($em, $app);


$app->post('/whiskylike', function() use ($contr){
    $contr->addLike();
})->name('whiskylike');

/* Olivier */