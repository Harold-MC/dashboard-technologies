<?php

namespace App\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class DoctrineConfig
{
    public static function getEntityManager(): EntityManagerInterface
    {
        $paths = [__DIR__ . '/../../../Domain/Entity'];

        $isDevMode = true;

        $dbParams = [
            'driver'   => 'pdo_mysql',
            'host'     => getenv('DB_HOST'),
            'user'     => getenv('DB_PORT'),
            'password' => getenv('DB_NAME'),
            'dbname'   => getenv('DB_USER'),
            'port'     => getenv('DB_PASS'),
        ];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        $connection = DriverManager::getConnection($dbParams, $config);
        $entityManager = new EntityManager($connection, $config);

        return $entityManager;
    }
}
