<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function (\Slim\Container $c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function (\Slim\Container $c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// doctrine
$container['orm'] = function (\Slim\Container $c) {
    $dbParams = $c->get('settings')['orm'];

    $paths = array(__DIR__ . '/models');
    $isDevMode = false; // FIXME get from settings?

    $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    return Doctrine\ORM\EntityManager::create($dbParams, $config);
};
