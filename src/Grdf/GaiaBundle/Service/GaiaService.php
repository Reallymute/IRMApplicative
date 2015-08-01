<?php

namespace Grdf\GaiaBundle\Service;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GaiaService extends ContainerAware
{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    //public $container;
    
    //  MARC LATEST WORK 31 july 2015
    public function __construct(ContainerInterface $conty) {
        
        $this->setContainer($conty);
    }
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    public $em;

    private function getGroupFromGaia($gaia)
    {
        $o = $this->em->getRepository('GrdfGaiaBundle:User')->find($gaia);
        if ($o instanceof \Grdf\GaiaBundle\Entity\User && $o->getGroup()) {
            return $o->getGroup()->getId();
        }
        return null;
    }

    /**
     * Recupere toutes les infos gaia necessaires
     *
     * @return type
     */
    public function getGaiaValues($keyAsked = null)
    {
        $mapping = array(
            'HTTP_SM_UNIVERSALID' => 'gaia',
            'HTTP_GAIA_NNI' => 'nni',
            'HTTP_GAIA_CIVILITE' => 'civility',
            'HTTP_GAIA_PRENOM' => 'firstname',
            'HTTP_GAIA_NOM' => 'name',
            'HTTP_GAIA_EMAIL' => 'email'
        );

        $o = array();

        foreach ($mapping as $key => $value) {
            $o[$value] = $this->getGaiaValueByKey($key);
        }

        $o['group'] = null;
        if ($o['gaia']) {
            $o['group'] = $this->getGroupFromGaia($o['gaia']);
        }

        //$o['gaia'] = 'BX2076';

        if ($keyAsked) {
            return $o[$keyAsked];
        }
        return $o;
    }

    /**
     * Get an header value
     *
     * @param string $key
     * @return string
     */
    private function getGaiaValueByKey($key)
    {
        $key = str_replace('HTTP_', '', $key);
        $key = str_replace('_', '-', $key);
        $key = strtolower($key);

        return $this->container->get('request')->headers->get($key);
        // MARC repleaced line above with one below
        
        //return $this->get('request')->headers->get($key);
    }
public function getGaiaStatus() {
    
   // $this->container = new ContainerBuilder();

    if (is_object($this->container)) {
        
        $this->container->set("grdf.gaiabundle.gaia",$this);
        return 'FUNCTIONING : CONTAINER IS INSTATIATED'; 
    }
    return 'ERROR : CONTAINER FAILED TO INSTATIATE';
}
}
