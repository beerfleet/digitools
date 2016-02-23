<?php

namespace digi\eslTools\Service\Esl;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use digi\eslTools\Entities\Esl;
use digi\eslTools\Service\Registration\RegistrationService;
use digi\eslTools\Service\Validation\EslClientValidation as EslVal;
use digi\eslTools\Entities\Store;

/**
* EslService
*
* @author Jan Van Biervliet
*/

class EslService {
  private $em;
  private $app;
  private $errors;  

  public function __construct($em, $app) {
    $this->em = $em;
    $this->app = $app;
    $this->errors = null;
  }

  public function getStoreGroups() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Storegroup');
    return $repo->findAll();
  }

  public function getStoreGroupById($id) {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Storegroup');
    return $repo->find($id);
  }

  public function getContracts() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Contract');
    return $repo->findAll();
  }

  public function getContracttypes() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Contracttype');
    return $repo->findAll();
  }

  public function getBackoffices() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Backoffice');
    return $repo->findAll();
  }

  /* retrieves necessary data to populate dropdowns for creating a new store */
  public function getForeignTablesData() {    
    $data['storegroups'] = $this->getStoreGroups();
    $regSrv = new RegistrationService($this->em, $this->app);
    $data['postcodes'] = $regSrv->getPostcodesByCity();
    $data['contracts'] = $this->getContracts();
    $data['backoffices'] = $this->getBackoffices();
    $data['contracttypes'] = $this->getContracttypes();
    return $data;
  }

  public function getErrors() {
    return $this->errors;
  }

  public function validateClient() {
    /* @var $val  EslClientValidation */
    $val = new EslVal($this->app, $this->em);
    $validated = $val->validate();
    $this->errors = $val->getErrors();
    return $validated;
  }

  public function storeEslClient() {
    /* @var $app Slim */
    $app = $this->app;
    if ($this->validateClient()) {
      /* @var $store Store */
      $store = new Store();      
      $store->setStorename($app->request->post('winkelnaam'));
      $store->setSynergie($app->request->post('synergie'));
      $store->setIp($app->request->post('ip'));
      $store->setSoftwareversion($app->request->post('softwareversion'));
      $store->setContact($app->request->post('contact'));
      $store->setEmail($app->request->post('e-mail'));
      $store->setStoregroup($this->getStoreGroupById($app->request->post('storegroup')));
      $store->setPostcode(fgf;

      var_dump($store);

    } else {
      echo "NIET GEVALIDEERD";
    }
  }
}