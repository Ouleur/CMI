<?php

// src/Cmi/ApiBundle/Controller/ApiController.php

namespace Cmi\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;

class ApiController extends FOSRestController
{
    public function indexAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }
}