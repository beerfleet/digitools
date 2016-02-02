<?php

require_once './vendor/autoload.php';
$config = require_once './config/config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Slim\Slim;
use Slim\Extras\Views\Twig;

// ---------------->  YAML
$namespaces = $config['yaml']['namespaces'];
$driver = new SimplifiedYamlDriver($namespaces);
$driver->setGlobalBasename('global'); // global.orm.yml

// ---------------->  Doctrine
$isDevMode = true;
$dbParams = $config['doctrine'];

// ----------------> YAML
$yml_config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/doctrine"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $yml_config);
$em = $entityManager;

// ---------------> Slim
$view = new Twig();
$view->twigOptions = $config['slim_twig'];
$view->twigExtensions = $config['slim_ext'];

$app = new Slim(array( 'view' => $view ));
$app->config($config['slim']);
