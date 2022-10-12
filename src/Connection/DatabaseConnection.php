<?php

declare(strict_types=1);

namespace App\Connection;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class DatabaseConnection
{
    public static function getEntityManager(): EntityManager
    {
        $params = [
            'driver' => 'pdo_mysql',
            'user' => 'alessandro',
            'password' => 'livre',
            'dbname' => 'db_iw_api',
        ];

        $paths = [
            dirname(__DIR__).'/Entity',
        ];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, true);

        return EntityManager::create($params, $config);
    }
}