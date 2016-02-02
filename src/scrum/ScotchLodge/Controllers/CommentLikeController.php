<?php

namespace scrum\ScotchLodge\Controllers;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Controllers\Controller;
use scrum\ScotchLodge\Service\CommentLike\CommentLikeService;
use scrum\ScotchLodge\Entities\CommentLike;

/**
 * CommentLikeController controller
 * 
 * @author Olivier Masudi 
 */
class CommentLikeController extends Controller{
    
    /*@var $commentlikesrv CommentLikeService */
    private $commentlikesrv;
    private $em;
    private $app;

    public function __construct($em, $app) {
        parent::__construct($em, $app);
        $this->commentlikesrv = new CommentLikeService($em, $app);
        $this->em = $em;
        $this->app = $app;
    }
    
    /**
     * Render the page to add a new event.
     */
    public function addLike(){  
        $this->commentlikesrv->addlike();        
    }

}