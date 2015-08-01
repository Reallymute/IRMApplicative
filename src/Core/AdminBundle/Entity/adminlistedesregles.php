<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * admin_listedesregles
 */
class adminlistedesregles
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $refIntRegle;

    /**
     * @var string
     */
    private $typeRegle;

    /**
     * @var string
     */
    private $regleNom;

    /**
     * @var string
     */
    private $refIntRegleLiee;

    /**
     * @var integer
     */
    private $statutActive;

    /**
     * @var integer
     */
    private $priorite;

    /**
     * @var string
     */
    private $critereInclusion;

    /**
     * @var string
     */
    private $critereExclusion;

    /**
     * @var string
     */
    private $ressourceInclusionRegle;

    /**
     * @var string
     */
    private $refTypeInsertionRegle;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set refIntRegle
     *
     * @param integer $refIntRegle
     * @return admin_listedesregles
     */
    public function setRefIntRegle($refIntRegle)
    {
        $this->refIntRegle = $refIntRegle;

        return $this;
    }

    /**
     * Get refIntRegle
     *
     * @return integer 
     */
    public function getRefIntRegle()
    {
        return $this->refIntRegle;
    }

    /**
     * Set typeRegle
     *
     * @param string $typeRegle
     * @return admin_listedesregles
     */
    public function setTypeRegle($typeRegle)
    {
        $this->typeRegle = $typeRegle;

        return $this;
    }

    /**
     * Get typeRegle
     *
     * @return string 
     */
    public function getTypeRegle()
    {
        return $this->typeRegle;
    }

    /**
     * Set regleNom
     *
     * @param string $regleNom
     * @return admin_listedesregles
     */
    public function setRegleNom($regleNom)
    {
        $this->regleNom = $regleNom;

        return $this;
    }

    /**
     * Get regleNom
     *
     * @return string 
     */
    public function getRegleNom()
    {
        return $this->regleNom;
    }

    /**
     * Set refIntRegleLiee
     *
     * @param string $refIntRegleLiee
     * @return admin_listedesregles
     */
    public function setRefIntRegleLiee($refIntRegleLiee)
    {
        $this->refIntRegleLiee = $refIntRegleLiee;

        return $this;
    }

    /**
     * Get refIntRegleLiee
     *
     * @return string 
     */
    public function getRefIntRegleLiee()
    {
        return $this->refIntRegleLiee;
    }

    /**
     * Set statutActive
     *
     * @param integer $statutActive
     * @return admin_listedesregles
     */
    public function setStatutActive($statutActive)
    {
        $this->statutActive = $statutActive;

        return $this;
    }

    /**
     * Get statutActive
     *
     * @return integer 
     */
    public function getStatutActive()
    {
        return $this->statutActive;
    }

    /**
     * Set priorite
     *
     * @param integer $priorite
     * @return admin_listedesregles
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;

        return $this;
    }

    /**
     * Get priorite
     *
     * @return integer 
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * Set critereInclusion
     *
     * @param string $critereInclusion
     * @return admin_listedesregles
     */
    public function setCritereInclusion($critereInclusion)
    {
        $this->critereInclusion = $critereInclusion;

        return $this;
    }

    /**
     * Get critereInclusion
     *
     * @return string 
     */
    public function getCritereInclusion()
    {
        return $this->critereInclusion;
    }

    /**
     * Set critereExclusion
     *
     * @param string $critereExclusion
     * @return admin_listedesregles
     */
    public function setCritereExclusion($critereExclusion)
    {
        $this->critereExclusion = $critereExclusion;

        return $this;
    }

    /**
     * Get critereExclusion
     *
     * @return string 
     */
    public function getCritereExclusion()
    {
        return $this->critereExclusion;
    }

    /**
     * Set ressourceInclusionRegle
     *
     * @param string $ressourceInclusionRegle
     * @return admin_listedesregles
     */
    public function setRessourceInclusionRegle($ressourceInclusionRegle)
    {
        $this->ressourceInclusionRegle = $ressourceInclusionRegle;

        return $this;
    }

    /**
     * Get ressourceInclusionRegle
     *
     * @return string 
     */
    public function getRessourceInclusionRegle()
    {
        return $this->ressourceInclusionRegle;
    }

    /**
     * Set refTypeInsertionRegle
     *
     * @param string $refTypeInsertionRegle
     * @return admin_listedesregles
     */
    public function setRefTypeInsertionRegle($refTypeInsertionRegle)
    {
        $this->refTypeInsertionRegle = $refTypeInsertionRegle;

        return $this;
    }

    /**
     * Get refTypeInsertionRegle
     *
     * @return string 
     */
    public function getRefTypeInsertionRegle()
    {
        return $this->refTypeInsertionRegle;
    }
}
