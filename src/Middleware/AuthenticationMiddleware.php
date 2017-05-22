<?php

namespace CosmoCode\SlimSkeleton\Middleware;


class AuthenticationMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {

        $login = $_SESSION["logged_in"] ?? null;
        $this->container->view->getEnvironment()->addGlobal('logged_in', $login);
        $response = $next($request, $response);
        return $response;
    }

}
