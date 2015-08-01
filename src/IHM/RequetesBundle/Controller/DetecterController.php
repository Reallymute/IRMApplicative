<?php

namespace IHM\RequetesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DetecterController extends Controller
{
    public function BPMAction()
    {
        return $this->render('IHMRequetesBundle:Detecter:BPM.html.twig', array(
                // ...
            ));    }

    public function MQAction()
    {
        return $this->render('IHMRequetesBundle:Detecter:MQ.html.twig', array(
                // ...
            ));    }

}
