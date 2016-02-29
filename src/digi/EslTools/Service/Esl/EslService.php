<?php

namespace digi\eslTools\Service\Esl;

use Doctrine\ORM\EntityManager;
use Slim\Slim;
use digi\eslTools\Entities\Esl;
use digi\eslTools\Entities\Contract;
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
  
  public function getStores() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Store');
    return $repo->findAll();
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

  public function getContractById($id) {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Contract');
    return $repo->find($id);
  }

  public function getContracttypes() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Contracttype');
    return $repo->findAll();
  }

  public function getContracttypeById($id) {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Contracttype');
    return $repo->find($id);
  }

  public function getBackoffices() {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Backoffice');
    return $repo->findAll();
  }

  public function getBackofficeById($id) {
    $repo = $this->em->getRepository('digi\eslTools\Entities\Backoffice');
    return $repo->find($id);
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
      $store->setSoftwareversion($app->request->post('softwareversie'));
      $store->setContact($app->request->post('contact'));
      $store->setEmail($app->request->post('e-mail'));
      $store->setPicurl($app->request->post('picurl'));
      $store->setStoregroup($this->getStoreGroupById($app->request->post('storegroup')));
      $em = $this->em;      
      $reg_srv = new RegistrationService($em, $app);
      $store->setPostcode($reg_srv->getPostcodeObject($app->request->post('postcode')));
      $store->setContract($this->getContractById($app->request->post('contract')));      
      $store->setContracttype($this->getContracttypeById($app->request->post('contracttype')));
      $store->setBackoffice($this->getBackofficeById($app->request->post('backoffice')));
      $em->persist($store);
      $em->flush();
      $app->flash('info', $store->getStorename() . " is opgeslagen");
      return true;
    } else {
      return false;
    }
  }
}