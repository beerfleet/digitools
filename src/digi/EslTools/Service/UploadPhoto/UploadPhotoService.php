<?php

namespace scrum\ScotchLodge\Service\UploadPhoto;

use Doctrine\ORM\EntityManager;
use Slim\Slim;

/**
 * UploadPhotoService
 *
 * @author joeri broos
 */

class UploadPhotoService{
    
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
    
        
    
    private function ControlPhoto($_FILES,$url,$name){

        //Folder where the image is stored, don't forget the write permissions on the folder
        $location = "img/" + $url;
        
        if(is_uploaded_file($_FILES['photo']['tmp_name'])){
            //Checks the size, max. size in bytes
            if($_FILES['photo']['size']>51200){
              return $PhotoSize = true;
            }

            //Check extension
            if(!eregi("((.gif|.jpg)$)", $_FILES['photo']['name'])){
               return $PhotoExtension = true;
            }

            //Check measurements
            $size = getimagesize($_FILES['photo']['tmp_name']);
            $width = $size[0];
            $height = $size[1];
            if($width > "350" && $height > "250"){
              return $PhotoMeasurements = true;
            }
            if($width > "250" && $height > "350"){
              return $PhotoMeasurements = true;
            }
            
            //Move image
            if(!move_uploaded_file($_FILES['photo']['tmp_name'],$location.$_FILES['photo']['name'])){
              return $PhotoError = true;
            }

            //Return name to form
            $_FILES['photo']['name'] = $name;
            return $PhotoName = $_FILES['photo']['name'];
        }
    }

}