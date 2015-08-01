<?php

namespace Grdf\GaiaBundle\Twig;

class GaiaExtension extends \Twig_Extension
{

    /**
     * @var \Grdf\GaiaBundle\Service\GaiaService 
     */
    public $gaia;

    public function getFunctions()
    {
        return array(
            'gaiaInfos' => new \Twig_Function_Method($this, 'gaiaInfosFunction')
        );
    }

    public function gaiaInfosFunction($key)
    {
        //Retour
        return $this->gaia->getGaiaValues($key);
    }

    public function getName()
    {
        return 'grdf_gaia_extension';
    }

}
