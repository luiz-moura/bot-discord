<?php

namespace Infra\Persistence\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__.'/Entities'],
    isDevMode: $_ENV['APP_ENV'] === 'dev',
);

$connection = DriverManager::getConnection(
    require_once __DIR__ . '/../../../../config/doctrine.php',
    $config
);

return new EntityManager($connection, $config);
