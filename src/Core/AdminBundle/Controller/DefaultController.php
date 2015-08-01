<?php

namespace Core\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
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
        }

