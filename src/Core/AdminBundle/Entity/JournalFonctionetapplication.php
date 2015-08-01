<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JournalFonctionetapplication
 */
class JournalFonctionetapplication
{
    /**
     * @var integer
     */
    private $no;

    /**
     * @var string
     */
    private $typejournal;

    /**
     * @var string
     */
    private $cleExtApplication;

    /**
     * @var string
     */
    private $cleExtFonction;

    /**
     * @var string
     */
    private $nomapplication;

    /**
     * @var string
     */
    private $nomfonction;

    /**
     * @var \DateTime
     */
    private $datedebutperioderef;

    /**
     * @var \DateTime
     */
    private $datepremiereactivite;

    /**
     * @var \DateTime
     */
    private $datearretactivite;

    /**
     * @var string
     */
    private $cleExtRelationLogique;

    /**
     * @var string
     */
    private $cleExtProvenance;

    /**
     * @var \DateTime
     */
    private $datefindeperioderef;


    /**
     * Get no
     *
     * @return integer 
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * Set typejournal
     *
     * @param string $typejournal
     * @return JournalFonctionetapplication
     */
    public function setTypejournal($typejournal)
    {
        $this->typejournal = $typejournal;

        return $this;
    }

    /**
     * Get typejournal
     *
     * @return string 
     */
    public function getTypejournal()
    {
        return $this->typejournal;
    }

    /**
     * Set cleExtApplication
     *
     * @param string $cleExtApplication
     * @return JournalFonctionetapplication
     */
    public function setCleExtApplication($cleExtApplication)
    {
        $this->cleExtApplication = $cleExtApplication;

        return $this;
    }

    /**
     * Get cleExtApplication
     *
     * @return string 
     */
    public function getCleExtApplication()
    {
        return $this->cleExtApplication;
    }

    /**
     * Set cleExtFonction
     *
     * @param string $cleExtFonction
     * @return JournalFonctionetapplication
     */
    public function setCleExtFonction($cleExtFonction)
    {
        $this->cleExtFonction = $cleExtFonction;

        return $this;
    }

    /**
     * Get cleExtFonction
     *
     * @return string 
     */
    public function getCleExtFonction()
    {
        return $this->cleExtFonction;
    }

    /**
     * Set nomapplication
     *
     * @param string $nomapplication
     * @return JournalFonctionetapplication
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
     * Set nomfonction
     *
     * @param string $nomfonction
     * @return JournalFonctionetapplication
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
     * Set datedebutperioderef
     *
     * @param \DateTime $datedebutperioderef
     * @return JournalFonctionetapplication
     */
    public function setDatedebutperioderef($datedebutperioderef)
    {
        $this->datedebutperioderef = $datedebutperioderef;

        return $this;
    }

    /**
     * Get datedebutperioderef
     *
     * @return \DateTime 
     */
    public function getDatedebutperioderef()
    {
        return $this->datedebutperioderef;
    }

    /**
     * Set datepremiereactivite
     *
     * @param \DateTime $datepremiereactivite
     * @return JournalFonctionetapplication
     */
    public function setDatepremiereactivite($datepremiereactivite)
    {
        $this->datepremiereactivite = $datepremiereactivite;

        return $this;
    }

    /**
     * Get datepremiereactivite
     *
     * @return \DateTime 
     */
    public function getDatepremiereactivite()
    {
        return $this->datepremiereactivite;
    }

    /**
     * Set datearretactivite
     *
     * @param \DateTime $datearretactivite
     * @return JournalFonctionetapplication
     */
    public function setDatearretactivite($datearretactivite)
    {
        $this->datearretactivite = $datearretactivite;

        return $this;
    }

    /**
     * Get datearretactivite
     *
     * @return \DateTime 
     */
    public function getDatearretactivite()
    {
        return $this->datearretactivite;
    }

    /**
     * Set cleExtRelationLogique
     *
     * @param string $cleExtRelationLogique
     * @return JournalFonctionetapplication
     */
    public function setCleExtRelationLogique($cleExtRelationLogique)
    {
        $this->cleExtRelationLogique = $cleExtRelationLogique;

        return $this;
    }

    /**
     * Get cleExtRelationLogique
     *
     * @return string 
     */
    public function getCleExtRelationLogique()
    {
        return $this->cleExtRelationLogique;
    }

    /**
     * Set cleExtProvenance
     *
     * @param string $cleExtProvenance
     * @return JournalFonctionetapplication
     */
    public function setCleExtProvenance($cleExtProvenance)
    {
        $this->cleExtProvenance = $cleExtProvenance;

        return $this;
    }

    /**
     * Get cleExtProvenance
     *
     * @return string 
     */
    public function getCleExtProvenance()
    {
        return $this->cleExtProvenance;
    }

    /**
     * Set datefindeperioderef
     *
     * @param \DateTime $datefindeperioderef
     * @return JournalFonctionetapplication
     */
    public function setDatefindeperioderef($datefindeperioderef)
    {
        $this->datefindeperioderef = $datefindeperioderef;

        return $this;
    }

    /**
     * Get datefindeperioderef
     *
     * @return \DateTime 
     */
    public function getDatefindeperioderef()
    {
        return $this->datefindeperioderef;
    }
}
