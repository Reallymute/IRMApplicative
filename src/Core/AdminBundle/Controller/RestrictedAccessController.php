<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestrictedAccessController extends Controller
{
    public function adminhomeAction()
    {
        return $this->render('CoreAdminBundle:RestrictedAccess:adminhome.html.twig', array(
                // ...
            ));    }

}
