<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\DependencyInjection\ContainerBuilder;

use JMS\DiExtraBundle\Annotation as DI;

class HomeController extends Controller
{
    
    /**
     * <atSign>DI\Inject("irm_security.security")
     * <atSign>var \Core\IRMSecurityBundle\Service\IRMSecurityService
       * <atSign>DI\Inject("grdf.gaiabundle.gaia")
      * <atSign>var \Grdf\GaiaBundle\Service\GaiaService
      * @DI\Inject("irm_security.security")
     * @var \Core\IRMSecurityBundle\Service\IRMSecurityService
 * 
     */
    public $gaia;

    //public $container;
    
    public function indexidAction($id)
    {
        //$dernierAcces = new \Core\AdminBundle\Entity\VerifConnex();
       $fooo = $this->getDoctrine()->getManager();
       //$qtyy = new \Doctrine\ORM\Query();
       //$qtyy->getArrayResult()
      // $dernierAcces = $fooo->find('VerifConnex()',1);
       //$rep = new \Doctrine\ORM\EntityRepository();
       //$rep->
       $rep = $this->getDoctrine()->getRepository('CoreAdminBundle:VerifConnex');
       $dernierAcces = $rep->findOneById(1);
       //$rep2 = $this->getDoctrine()->getRepository('CoreAdminBundle:admin_listedesregles');
       $rep2 = $this->getDoctrine()->getRepository('CoreAdminBundle:adminlistedesregles');
       $dernierAcces2 = $rep2->findAll();
     
      //$qtyy = $fooo->createQuery("SELECT 'y.DateAccess' FROM 'CoreAdminBundle:VerifConnex' 'y'");
       $qtyy = $fooo->createQuery("SELECT '*' FROM 'CoreAdminBundle:VerifConnex' 'y'");
      //if(isob)
     //$fooo->refresh($dernierAcces);
      // $dernierAcces->setDateAcces(new \DateTime('2015-12-31 23:44:33'));
       //$dernierAcces->setDateAcces('2015-12-31 23:44:33');
              //$fooo->flush();
       $artt = $qtyy->getArrayResult();
       //print_r($artt);
       
       if (is_object($dernierAcces)) {
        $strdate = date_format($dernierAcces->getDateAccess(),"Y-m-d");
        $i = 0;
        $regle = $this->extraireRegles($dernierAcces2);

        $reglenom = $dernierAcces2[1]->getRegleNom();
        
       }
       else {
           $artt[] = "Crap";
           $strdate = "2015-04-30";
          $reglenom = "Erreur en extraction" ;
           $regle = "hhh";
       }
        //$regle = "Snnop";
        //$strdate = date_format($artt[0]['DateAccess'],"Y-m-d");
        //return $this->render('CoreAdminBundle:Home:index.html.twig', array('id' => $id,'access' => $strdate, 'ertu' => $artt[0],'regles'=>$regle, 'reglenom'=>$reglenom));
        return $this->render('CoreAdminBundle:Default:index.html.twig', array('id' => $id,'access' => $strdate, 'ertu' => $artt[0],'regles'=>$regle, 'reglenom'=>$reglenom));
    }
    public function indexAction() {
        return $this->indexidAction("NULL");
    }
    public function zoomAction(Request $request,$slug) {
 
        
          //  $this->container = new ContainerBuilder();
      //  $this->container->set("request",$request);

            //  MARC LAST WORKED HERE  error ; Doctrine not declared cause : creation of container above
        $repid = 'CoreAdminBundle:adminlistedesregles';
       $rep2 = $this->getDoctrine()->getRepository($repid);
       $dernierAcces2 = $rep2->findBy(Array('id'=>"=".$slug));
       $dernierAcces2 = $rep2->find($slug);
       
        $regle = $this->extraireRegles($dernierAcces2);
        
        
        if (is_null($regle) ) {
       $regle = Array(0=>Array('nom'=>"AUCUNE REGLE CORRESPOND A ID "."=".$slug." Dans ".$repid,'status'=>"LISTE VIDE",'incluscrit'=>"",'inclusregle'=>"",'id'=>""));
            }
        else {
            if (array_key_exists(0, $regle)) {
                
            }
            else {
        $regle = Array(0=>Array('nom'=>"AUCUNE REGLE CORRESPOND A ID "."=".$slug." Dans ".$repid,'status'=>"LISTE VIDE",'incluscrit'=>"",'inclusregle'=>"",'id'=>""));
               
            }
            
        }
        $auth = "";
            $auth = $auth.$this->gaia->getIRMSecurityStatus();
            
          //  $auth = $auth.$this->gaia->getGaiaValues('gaia');
    
        if ($this->isAdmin()) {
        $auth = $auth."I am Admin";
        }
        else {
        $auth = $auth."I am dangerous";
              
        }
        
          return $this->render('CoreAdminBundle:Home:zoom.html.twig', array('auth' => $auth,'id' => $slug,'rq'=>$request->getBaseUrl(),'regles'=>$regle));
           
    }
        public function isAdmin()
    {
            // MARC LAST WORK ; gaia injection is not working
            
       //  if ($this->gaia->getGaiaValues('group') == 'admin') {
         /* 
        if ($this->gaia->getGaiaValues('gaia') == 'TX5212') {
            //Retour
            return true;
        } 
          */ 
        //Retour
        return false;
    }

    private function extraireRegles($dernierAcces2) {
       $repid = 'CoreAdminBundle:adminlistedesregles';
       $regle = null;

        if (is_array($dernierAcces2)) {
            $i = 0;
          foreach($dernierAcces2 as $regleobj ) {
              $regle[$i] = Array('nom'=>$regleobj->getRegleNom(),
                                'status'=>$regleobj->getStatutActive(),
                                'incluscrit'=>$regleobj->getCritereInclusion(),
                                'inclusregle'=>$regleobj->getRessourceInclusionRegle(),
                                'id'=>$regleobj->getId());
              $i = $i + 1;
          }

        }
        else {
            
            if (is_object($dernierAcces2)) {
                $ArrObject[] = $dernierAcces2;
            $regle = $this->extraireRegles($ArrObject);
                
            }
            else {
            $regle = Array(0=>Array('nom'=>"ECHEC REQUETE SUR ENTITE ".$repid,'status'=>"CONTENU : ",'incluscrit'=>"",'inclusregle'=>"",'id'=>""));
            }
        }
        
        return $regle;
    }
}
