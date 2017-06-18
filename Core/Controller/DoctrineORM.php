<?php
/**
 * Created by PhpStorm.
 * User: vmoul
 * Date: 16/06/2017
 * Time: 17:07
 */

namespace Core\Controller;
require_once "vendor/autoload.php";


class DoctrineORM
{

    protected $entityManager;

    /**
     * Controller constructor.
     */
    public function __construct(){
        $entityPath = array("App/Entity");
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($entityPath, false);
        $databaseParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'mytek',
        );
        $this->entityManager = \Doctrine\ORM\EntityManager::create($databaseParams, $config);
    }


}