#!/usr/bin/php
<?php
/**
 * Console tool to run doctrine stuff
 *
 * @todo extend this to allow defining our own commands
 */
use Doctrine\DBAL\Migrations\OutputWriter;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\HelperSet;


/** @var \Slim\App $app */
$app = require __DIR__ . '/src/app.php';

// helpers needed
$helperSet = new HelperSet(array(
    'db' => new ConnectionHelper($app->getContainer()->get('orm')->getConnection()),
    'em' => new EntityManagerHelper($app->getContainer()->get('orm')),
    'dialog' => new DialogHelper(),
));

// replace the ConsoleRunner::run() statement with:
$cli = new Application('Doctrine Command Line Interface', \Doctrine\ORM\Version::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

// Register All Default Doctrine Commands
ConsoleRunner::addCommands($cli);

// prepare migration config
$configuration = new \Doctrine\DBAL\Migrations\Configuration\Configuration(
    $app->getContainer()->get('orm')->getConnection(),
    new OutputWriter()
);
$configuration->setMigrationsDirectory(__DIR__ . '/migrations');
$configuration->setName('Migrations');
$configuration->setMigrationsNamespace('Migrations');
$configuration->setMigrationsTableName('migrations');
$configuration->registerMigrationsFromDirectory(__DIR__ . '/migrations');

// add config to commands and add them to the CLI runner
$commands = [
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
];
foreach ($commands as $cmd) $cmd->setMigrationConfiguration($configuration);
$cli->addCommands($commands);


// Runs console application
$cli->run();
