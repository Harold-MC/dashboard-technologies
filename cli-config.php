<?php

require 'vendor/autoload.php';

use App\Infrastructure\Persistence\Doctrine\DoctrineConfig;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

$config = new PhpFile('migrations.php');

$entityManager = DoctrineConfig::getEntityManager();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));