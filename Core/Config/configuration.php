<?php

require_once "vendor/autoload.php";

$databaseParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'mytek',
);

$entityPath = array("App/Entity");

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($entityPath, false);

$entityManager = \Doctrine\ORM\EntityManager::create($databaseParams, $config);