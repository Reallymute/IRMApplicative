<?php
// fichier : %symfony2 root folder%\src\Core\IRMSecurityBundle\Service\IRMService.php

// Arboresence sous-dossier ; %symfony2 root folder%\src\Core\IRMSecurityBundle = %bundle-root%
namespace Core\IRMSecurityBundle\Service;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Cette classe prend en charge les aspects sécurité de l'IRM Applicative
 */

class IRMSecurityService extends ContainerAware
{
    
    private $localSecurityServiceObj;
    private $localSecurityServiceId;
    /**
     * Constructeur déclaré dans %bundle-root%/Resources/config/services.xml
     * @param ContainerInterface $conty Un container ayant des références aux services implémentée pour cette session
     * @param string $_localSecurityServiceName (Source : Injection d'arguments; paramètres dans %bundle-root%/Resources/config/service.yml/irm_security.security)
     */
    public function __construct(ContainerInterface $conty, $_localSecurityServiceName = "grdf.gaiabundle.gaia") {
        
        $this->setContainer($conty);
       //  Expected : "grdf.gaiabundle.gaia"
        $this->localSecurityServiceId = $_localSecurityServiceName;
    }
//    
//    /**
//     * @var \Doctrine\ORM\EntityManager
//     */
//    public $em;
//
//    private function getGroupFromGaia($gaia)
//    {
//        $o = $this->em->getRepository('GrdfGaiaBundle:User')->find($gaia);
//        if ($o instanceof \Grdf\GaiaBundle\Entity\User && $o->getGroup()) {
//            return $o->getGroup()->getId();
//        }
//        return null;
//    }
//
//    /**
//     * Recupere toutes les infos gaia necessaires
//     *
//     * @return type
//     */
//    public function getGaiaValues($keyAsked = null)
//    {
//        $mapping = array(
//            'HTTP_SM_UNIVERSALID' => 'gaia',
//            'HTTP_GAIA_NNI' => 'nni',
//            'HTTP_GAIA_CIVILITE' => 'civility',
//            'HTTP_GAIA_PRENOM' => 'firstname',
//            'HTTP_GAIA_NOM' => 'name',
//            'HTTP_GAIA_EMAIL' => 'email'
//        );
//
//        $o = array();
//
//        foreach ($mapping as $key => $value) {
//            $o[$value] = $this->getGaiaValueByKey($key);
//        }
//
//        $o['group'] = null;
//        if ($o['gaia']) {
//            $o['group'] = $this->getGroupFromGaia($o['gaia']);
//        }
//
//        //$o['gaia'] = 'BX2076';
//
//        if ($keyAsked) {
//            return $o[$keyAsked];
//        }
//        return $o;
//    }
//
//    /**
//     * Get an header value
//     *
//     * @param string $key
//     * @return string
//     */
//    private function getGaiaValueByKey($key)
//    {
//        $key = str_replace('HTTP_', '', $key);
//        $key = str_replace('_', '-', $key);
//        $key = strtolower($key);
//
//        return $this->container->get('request')->headers->get($key);
//
//    }
    
/**
 * Methode qui obtient le status Gaia sur service Gaia 'grdf.gaiabundle.gaia'
 * @return string with arbitrary status description
 */    
public function getIRMSecurityStatus() {
    
 $retval = "ERROR : In getIRMSecurityStatus : FAILED TO GET CONTAINER";
    if (is_object($this->container)) {
        
       $this->localSecurityServiceObj = $this->container->get($this->localSecurityServiceId);
       
       $retval =  $this->localSecurityServiceObj->getGaiaStatus();
        
    }
    return $retval;
}
}
