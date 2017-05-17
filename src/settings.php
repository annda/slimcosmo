<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Doctrine ORM
        'orm' => [
            'driver'   => 'pdo_mysql',
            'user'     => 'admin',
            'password' => 'k4olo72',
            'dbname'   => 'slimcosmo',
            'unix_socket'   => '/opt/local/var/run/mysql56/mysqld.sock'
        ],
    ],
];
