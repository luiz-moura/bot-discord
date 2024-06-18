<?php

require __DIR__ . '/../bootstrap/app.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\Migrations\Tools\Console\Command;

$entityManager = require_once __DIR__ . '/../src/Infra/Persistence/Doctrine/connection.php';

$commands = [
    new Command\DiffCommand(),
    new Command\ExecuteCommand(),
    new Command\GenerateCommand(),
    new Command\LatestCommand(),
    new Command\MigrateCommand(),
    new Command\RollupCommand(),
    new Command\StatusCommand(),
    new Command\UpToDateCommand(),
    new Command\VersionCommand(),
    new Command\ListCommand(),
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);
