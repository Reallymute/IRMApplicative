<?php

namespace Core\ExtensibleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CoreExtensibleBundle:Default:index.html.twig', array('name' => $name));
    }
}
