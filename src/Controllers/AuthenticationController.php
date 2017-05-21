<?php

namespace CosmoCode\SlimSkeleton\Controllers;

class AuthenticationController extends BaseController
{

    public function login($request, $response)
    {
        return $this->view->render($response, 'login.twig', array('logged_in' => $_SESSION["logged_in"]));
    }

    public function in($request, $response)
    {
        $_SESSION["logged_in"] = "1";
        return $this->view->render($response, 'login.twig', array('logged_in' => $_SESSION["logged_in"]));
    }

    public function logout($request, $response)
    {
        return $this->view->render($response, 'logout.twig', array('logged_in' => $_SESSION["logged_in"]));
    }

    public function out($request, $response)
    {
        $_SESSION["logged_in"] = null;
        return $this->view->render($response, 'logout.twig', array('logged_in' => $_SESSION["logged_in"]));
    }
}