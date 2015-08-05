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

    
    
/**
 * Methode qui obtient le status sur le service qui est précisé dans
 * le fichier service.yml qui se trouve dans :
 *   %bundle-root%/Resources/config/service.yml/irm_security.security
 * @return string with arbitrary status description depending on base security service
 */    
public function getIRMSecurityStatus() {
    
 $retval = "ERROR : In getIRMSecurityStatus : FAILED TO GET CONTAINER";
    if (is_object($this->container)) {
        
       $this->localSecurityServiceObj = $this->container->get($this->localSecurityServiceId);
       
       $retval =  $this->localSecurityServiceObj->getGaiaStatus();
        
    }
    return $retval;
}
/**
 * renvoi une liste des capacités de la classe de services IRMSecurity
 * @version 0.1
 * @param numeric $positionInList un nombre entier > 0 visant une capacité ayant un numéro d'ordre
 * @param string $format valeurs attendues YAML | JSON
 * @return string
 */
public function getCapabilities($positionInList,$format = "YAML") {
    $positionRequested = 0;
    $retval = "ERROR : Pas de capacités inscrites";
    if (is_null($positionInList)) {
        
    }
    else {
        if (is_numeric($positionInList)) {
            if ($positionInList > 0 && $positionInList < 2500) {
                $positionRequested = $positionInList;
            }
        }
    }
    $retval = "countofcapabilities : 1\n"
."capabilities:\n"
    ."getSecurityStatus:\n"
        ."return: string\n"
        ."arguments: []\n";
 
    
    switch ($format) {
        case "YAML":


            break;
        case "JSON":


            break;

        default:
            break;
    }
     // TODO: créer la liste des capacités sous forme de structure YAML ou JSON
    return $retval;
   
    }
    
}

