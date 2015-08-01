<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReferentielhistoriqueFonction
 */
class ReferentielhistoriqueFonction
{
    /**
     * @var integer
     */
    private $cleExtFonctionid;

    /**
     * @var string
     */
    private $cleExtApplicationidexterne;

    /**
     * @var string
     */
    private $nomfonction;

    /**
     * @var string
     */
    private $descriptionfonction;

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
     * Get cleExtFonctionid
     *
     * @return integer 
     */
    public function getCleExtFonctionid()
    {
        return $this->cleExtFonctionid;
    }

    /**
     * Set cleExtApplicationidexterne
     *
     * @param string $cleExtApplicationidexterne
     * @return ReferentielhistoriqueFonction
     */
    public function setCleExtApplicationidexterne($cleExtApplicationidexterne)
    {
        $this->cleExtApplicationidexterne = $cleExtApplicationidexterne;

        return $this;
    }

    /**
     * Get cleExtApplicationidexterne
     *
     * @return string 
     */
    public function getCleExtApplicationidexterne()
    {
        return $this->cleExtApplicationidexterne;
    }

    /**
     * Set nomfonction
     *
     * @param string $nomfonction
     * @return ReferentielhistoriqueFonction
     */
    public function setNomfonction($nomfonction)
    {
        $this->nomfonction = $nomfonction;

        return $this;
    }

    /**
     * Get nomfonction
     *
     * @return string 
     */
    public function getNomfonction()
    {
        return $this->nomfonction;
    }

    /**
     * Set descriptionfonction
     *
     * @param string $descriptionfonction
     * @return ReferentielhistoriqueFonction
     */
    public function setDescriptionfonction($descriptionfonction)
    {
        $this->descriptionfonction = $descriptionfonction;

        return $this;
    }

    /**
     * Get descriptionfonction
     *
     * @return string 
     */
    public function getDescriptionfonction()
    {
        return $this->descriptionfonction;
    }

    /**
     * Set datemiseenservice
     *
     * @param \DateTime $datemiseenservice
     * @return ReferentielhistoriqueFonction
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
     * @return ReferentielhistoriqueFonction
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
     * @return ReferentielhistoriqueFonction
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
     * @return ReferentielhistoriqueFonction
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
