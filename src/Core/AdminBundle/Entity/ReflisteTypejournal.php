<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReflisteTypejournal
 */
class ReflisteTypejournal
{
    /**
     * @var integer
     */
    private $refIntTypejournal;

    /**
     * @var string
     */
    private $typejournal;

    /**
     * @var integer
     */
    private $prioritecategorie;

    /**
     * @var integer
     */
    private $prioriteenumeration;


    /**
     * Get refIntTypejournal
     *
     * @return integer 
     */
    public function getRefIntTypejournal()
    {
        return $this->refIntTypejournal;
    }

    /**
     * Set typejournal
     *
     * @param string $typejournal
     * @return ReflisteTypejournal
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
     * Set prioritecategorie
     *
     * @param integer $prioritecategorie
     * @return ReflisteTypejournal
     */
    public function setPrioritecategorie($prioritecategorie)
    {
        $this->prioritecategorie = $prioritecategorie;

        return $this;
    }

    /**
     * Get prioritecategorie
     *
     * @return integer 
     */
    public function getPrioritecategorie()
    {
        return $this->prioritecategorie;
    }

    /**
     * Set prioriteenumeration
     *
     * @param integer $prioriteenumeration
     * @return ReflisteTypejournal
     */
    public function setPrioriteenumeration($prioriteenumeration)
    {
        $this->prioriteenumeration = $prioriteenumeration;

        return $this;
    }

    /**
     * Get prioriteenumeration
     *
     * @return integer 
     */
    public function getPrioriteenumeration()
    {
        return $this->prioriteenumeration;
    }
}
