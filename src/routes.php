<?php

use Slim\Http\Request;
use Slim\Http\Response;
// Routes

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/home', function (Request $request, Response $response) {
    return $this->view->render($response, 'home.twig');
});

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/login', 'AuthenticationController:login')->setName('login');
$app->post('/login', 'AuthenticationController:in');

$app->get('/logout', 'AuthenticationController:logout')->setName('logout');
$app->post('/logout', 'AuthenticationController:out');
