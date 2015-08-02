<?php

namespace Core\IRMSecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IRMSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
