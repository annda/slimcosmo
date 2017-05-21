<?php

namespace CosmoCode\SlimSkeleton\Middleware;


class AuthenticationMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {

        $this->container->view->getEnvironment()->addGlobal('logged_in', $_SESSION["logged_in"]);
        $response = $next($request, $response);
        return $response;
    }

}
