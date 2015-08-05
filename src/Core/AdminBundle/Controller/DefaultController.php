<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JMS\DiExtraBundle\Annotation as DI;

class DefaultController extends Controller
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
    public $irmsecurity;
    
    public function indexAction($id)
    {
        return $this->render('CoreAdminBundle:Default:index.html.twig', array('id' => $id));
    }
    
    public function accueilAction($slug)
    {
        
        if ($slug == "OPEN") {
            
            $fooo = $this->getDoctrine()->getManager();

            $rep2 = $this->getDoctrine()->getRepository('CoreAdminBundle:adminlistedesregles');
            $dernierAcces2 = $rep2->findAll();
            
            $regle = $this->extraireRegles($dernierAcces2);

            
            
            return $this->render('CoreAdminBundle:Default:targetCoreAccueil.html.twig',array('slug'=>$slug,'regles'=>$regle));
        }
        else {
            return $this->render('CoreAdminBundle:Default:index.html.twig', array('id' => $slug));
           
        }
    }
    public function tableaudebordAction($slug)
    {
            return $this->render('CoreAdminBundle:Default:targetCoreTDB.html.twig',array('slug'=>$slug));
        
    }
            
    public function maintenanceAction($slug)
    {
            return $this->render('CoreAdminBundle:Default:targetCoreMaintenance.html.twig',array('slug'=>$slug));
        
    }
     public function controlAction($slug)
    {
            return $this->render('CoreAdminBundle:Default:targetCoreAdmin.html.twig',array('slug'=>$slug));
        
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
    
    //  MARC LAST WORKED HERE AUG 2 2015
        public function zoomAction(Request $request,$slug) {
 
        
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
        // $irmsecurity a été injecté à l'instanciation de la class
         $auth = $this->irmsecurity->getIRMSecurityStatus();
         
         $auth = $auth.$this->irmsecurity->getCapabilities(1,"YAML");
          return $this->render('CoreAdminBundle:Default:zoom.html.twig', array('auth' => $auth,'id' => $slug,'rq'=>$request->getBaseUrl(),'regles'=>$regle));
           
    }

        }

