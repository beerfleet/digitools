<?php

/**
 * Global config file. Edit settings, provide DB credentials, and rename the file to config.php
 */

return array(
  'yaml' => array(
    'namespaces' => array(
      '/config/doctrine' => 'scrum\ScotchLodge\Entities'
      )
    ),
  'doctrine' => array(
    'driver' => 'pdo_mysql',
    'user' => ' ',            // fill in username
    'password' => ' ',        // fill in password
    'dbname' => ' '           // fill in db name
    ),
  'slim' => array(
    'templates.path' => 'html',
    'log.level' => 4,
    'log.enabled' => true,
    'log.writer' => new Slim\Extras\Log\DateTimeFileWriter(
      array(
        'path' => 'logs',
        //'name_format' => 'slim'
        )
      )
    ),
  'slim_twig' => array(
    'charset' => 'utf-8',
    'cache' => 'html/cache',
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => false
    ),
  'slim_ext' => array(
    'Twig_Extensions_Slim'
    )  
);