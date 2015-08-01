<?php

namespace IHM\DefaultBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Grdf\GaiaBundle\Annotation\RequiresGaia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Home controller.
 *
 * @Route("/ihm")
 */
class HomeController extends Controller
{

    /**
     * @DI\Inject("doctrine.orm.entity_manager")
     * @var \Doctrine\ORM\EntityManager
     */
    public $em;

    /**
     * Home.
     *
     * @Route("/ihm", name="home")
     * 
     * @Template()
     */
    public function indexAction()
    {
        //Récupération des actualités
        
         return $this->render('IHMDefaultBundle:layout.html.twig');
       
        //$actualities = $this->em->getRepository("IHMDefaultBundle:Actualite")->findBy($criteria = array(), $orderBy = array('priority' => 'asc'), $limit = 3);
        //return array('home' => 'accueil', 'actualities' => $actualities);
    }

}
