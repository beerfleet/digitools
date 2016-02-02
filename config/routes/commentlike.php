<?php
/* olivier */

use scrum\ScotchLodge\Controllers\CommentLikeController;

$contr = new CommentLikeController($em, $app);


$app->post('/commentlike', function() use ($contr){
    $contr->addLike();
})->name('commentlike');

/* Olivier */