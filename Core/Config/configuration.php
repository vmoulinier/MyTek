<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 16/06/2017
 * Time: 15:32
 */

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