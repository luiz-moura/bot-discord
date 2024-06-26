<?php

require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Dotenv\Dotenv;
use Doctrine\ORM\EntityManagerInterface;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

$builder = new ContainerBuilder();
$container = $builder
    ->addDefinitions(config('DI'))
    ->enableCompilation(__DIR__ . '/../tmp')
    ->writeProxiesToFile(true, __DIR__ . '/../tmp/proxies')
    ->build();

$entityManager = require __DIR__ . '/../src/Infra/Persistence/Doctrine/connection.php';
$container->set(EntityManagerInterface::class, $entityManager);
$container->set(EntityManager::class, $entityManager);

return $container;
