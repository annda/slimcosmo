<?php
/**
 * Configure the doctrine command line tool
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;

/** @var \Slim\App $app */
$app = require __DIR__ . '/src/app.php';
return ConsoleRunner::createHelperSet($app->getContainer()->get('orm'));