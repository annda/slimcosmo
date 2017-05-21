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

    $paths = array(__DIR__ . '/Models');
    $isDevMode = false; // FIXME get from settings?

    $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    return Doctrine\ORM\EntityManager::create($dbParams, $config);
};

//twig
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
        ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    return $view;
};

// controllers
$container['HomeController'] = function ($container) {
    return new \CosmoCode\SlimSkeleton\Controllers\HomeController($container);
};
$container['AuthenticationController'] = function ($container) {
    return new \CosmoCode\SlimSkeleton\Controllers\AuthenticationController($container);
};

// middleware
$app->add(new \CosmoCode\SlimSkeleton\Middleware\AuthenticationMiddleware($container));
