<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferentielhistoriqueProvenance
 */
class ReferentielhistoriqueProvenance
{
    /**
     * @var integer
     */
    private $cleExtProvenanceid;

    /**
     * @var string
     */
    private $nomprovenance;

    /**
     * @var string
     */
    private $descriptionprovenance;

    /**
     * @var \DateTime
     */
    private $datemiseenservice;

    /**
     * @var \DateTime
     */
    private $dateDisponibilite;

    /**
     * @var string
     */
    private $utilisateur;

    /**
     * @var \DateTime
     */
    private $datesuppression;


    /**
     * Get cleExtProvenanceid
     *
     * @return integer 
     */
    public function getCleExtProvenanceid()
    {
        return $this->cleExtProvenanceid;
    }

    /**
     * Set nomprovenance
     *
     * @param string $nomprovenance
     * @return ReferentielhistoriqueProvenance
     */
    public function setNomprovenance($nomprovenance)
    {
        $this->nomprovenance = $nomprovenance;

        return $this;
    }

    /**
     * Get nomprovenance
     *
     * @return string 
     */
    public function getNomprovenance()
    {
        return $this->nomprovenance;
    }

    /**
     * Set descriptionprovenance
     *
     * @param string $descriptionprovenance
     * @return ReferentielhistoriqueProvenance
     */
    public function setDescriptionprovenance($descriptionprovenance)
    {
        $this->descriptionprovenance = $descriptionprovenance;

        return $this;
    }

    /**
     * Get descriptionprovenance
     *
     * @return string 
     */
    public function getDescriptionprovenance()
    {
        return $this->descriptionprovenance;
    }

    /**
     * Set datemiseenservice
     *
     * @param \DateTime $datemiseenservice
     * @return ReferentielhistoriqueProvenance
     */
    public function setDatemiseenservice($datemiseenservice)
    {
        $this->datemiseenservice = $datemiseenservice;

        return $this;
    }

    /**
     * Get datemiseenservice
     *
     * @return \DateTime 
     */
    public function getDatemiseenservice()
    {
        return $this->datemiseenservice;
    }

    /**
     * Set dateDisponibilite
     *
     * @param \DateTime $dateDisponibilite
     * @return ReferentielhistoriqueProvenance
     */
    public function setDateDisponibilite($dateDisponibilite)
    {
        $this->dateDisponibilite = $dateDisponibilite;

        return $this;
    }

    /**
     * Get dateDisponibilite
     *
     * @return \DateTime 
     */
    public function getDateDisponibilite()
    {
        return $this->dateDisponibilite;
    }

    /**
     * Set utilisateur
     *
     * @param string $utilisateur
     * @return ReferentielhistoriqueProvenance
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return string 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set datesuppression
     *
     * @param \DateTime $datesuppression
     * @return ReferentielhistoriqueProvenance
     */
    public function setDatesuppression($datesuppression)
    {
        $this->datesuppression = $datesuppression;

        return $this;
    }

    /**
     * Get datesuppression
     *
     * @return \DateTime 
     */
    public function getDatesuppression()
    {
        return $this->datesuppression;
    }
}
