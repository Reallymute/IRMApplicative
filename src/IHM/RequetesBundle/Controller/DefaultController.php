<?php

namespace IHM\RequetesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IHMRequetesBundle:Default:index.html.twig', array('name' => $name));
    }
}
