<?php

require __DIR__ . '/../bootstrap/app.php';

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

$entityManager = require __DIR__ . '/../src/Infra/Persistence/Doctrine/connection.php';

$config = new PhpFile(realpath('./config/migrations.php'));
$dependencyFactory = DependencyFactory::fromEntityManager(
    $config,
    new ExistingEntityManager($entityManager)
);

$commands = [
    new Command\DumpSchemaCommand($dependencyFactory),
    new Command\ExecuteCommand($dependencyFactory),
    new Command\GenerateCommand($dependencyFactory),
    new Command\LatestCommand($dependencyFactory),
    new Command\ListCommand($dependencyFactory),
    new Command\MigrateCommand($dependencyFactory),
    new Command\RollupCommand($dependencyFactory),
    new Command\StatusCommand($dependencyFactory),
    new Command\SyncMetadataCommand($dependencyFactory),
    new Command\VersionCommand($dependencyFactory),
    new Command\DiffCommand($dependencyFactory),
    new Command\UpToDateCommand($dependencyFactory),
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);
