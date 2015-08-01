<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferentielhistoriqueApplication
 */
class ReferentielhistoriqueApplication
{
    /**
     * @var integer
     */
    private $cleExtApplicationidexterne;

    /**
     * @var string
     */
    private $nomapplication;

    /**
     * @var string
     */
    private $descriptif;

    /**
     * @var string
     */
    private $statut;


    /**
     * Get cleExtApplicationidexterne
     *
     * @return integer 
     */
    public function getCleExtApplicationidexterne()
    {
        return $this->cleExtApplicationidexterne;
    }

    /**
     * Set nomapplication
     *
     * @param string $nomapplication
     * @return ReferentielhistoriqueApplication
     */
    public function setNomapplication($nomapplication)
    {
        $this->nomapplication = $nomapplication;

        return $this;
    }

    /**
     * Get nomapplication
     *
     * @return string 
     */
    public function getNomapplication()
    {
        return $this->nomapplication;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return ReferentielhistoriqueApplication
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set statut
     *
     * @param string $statut
     * @return ReferentielhistoriqueApplication
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
