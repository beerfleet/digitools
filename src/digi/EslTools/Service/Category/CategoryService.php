<?php

namespace scrum\ScotchLodge\Service\Category;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use scrum\ScotchLodge\Entities\Category;
use scrum\ScotchLodge\Entities\User;

/**
 * CategoryService
 *
 * @author joeri broos
 */
class CategoryService {
    
    private $em;
    private $app;
    private $errors;

    public function __construct($em, $app) {
      $this->em = $em;
      $this->app = $app;
      $this->errors = null;
    }

    public function getErrors(){
        return $this->errors;
    }

    

/* Olivier */ 
    
    

    
    
    public function addCategory(){
                
        $name = $this->app->request->post('name');        
        if($name!="")
        {
        $category = new Category();
        $category->setCategory($name);
        $this->em->persist($category);
        $this->em->flush();
        return $category;
        }
        $this->errors = $val->getErrors();
        return false;
    }
    
    
    public function updateCategory(Category $category){
        $name = $this->app->request->post('name');
        if($category->getCategory() != $name){
          $category->setCategory($name);
        }

        $this->em->persist($category);
        $this->em->flush();
        return $category;
    }
    
    
        public function retrieveCategoryById($id){
        $category = $this->em->getRepository('scrum\ScotchLodge\Entities\Category')->find($id);
        if(count($category)> 0){
            return $category;
        }else{
            return null;
        }
    }
    
    
    
    
    public function deleteCategory(Category $category){
        $this->em->remove($category);
        $this->em->flush();
        return $category;
    }
    
    
    public function ShowAllCurrentCategories($em,$app){
    //$em = $this->getEntityManager();
    $categoryRepository = $em->getRepository('scrum\ScotchLodge\Entities\Category');
    $categories = $this->em->getRepository('scrum\ScotchLodge\Entities\Category')->findAll();
    if(count($categories)> 0){
            return $categories;
        }else{
            return null;
        }
    return $categories;
    
    }
    
    public function getCategories(){
    //$em = $this->getEntityManager();    
    $categories = $this->em->getRepository('scrum\ScotchLodge\Entities\Category')->findAll();
    if(count($categories)> 0){
            return $categories;
        }else{
            return null;
        }
    return $categories;
    
    }    
/* End Olivier */


    
    /* End Search functions */

}
