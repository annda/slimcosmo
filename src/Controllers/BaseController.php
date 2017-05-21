<?php

namespace CosmoCode\SlimSkeleton\Controllers;

class BaseController
{

    /**
     * @var \Slim\Container
     */
    protected $container;

    /**
     * @var \Slim\Views\Twig
     */
    protected $view;

    public function __construct($container)
    {
        $this->container = $container;
        $this->view = $container->view;
    }

}