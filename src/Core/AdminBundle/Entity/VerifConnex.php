<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VerifConnex
 */
class VerifConnex
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateAccess;


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
     * Set dateAccess
     *
     * @param \DateTime $dateAccess
     * @return VerifConnex
     */
    public function setDateAccess($dateAccess)
    {
        $this->dateAccess = $dateAccess;

        return $this;
    }

    /**
     * Get dateAccess
     *
     * @return \DateTime 
     */
    public function getDateAccess()
    {
        return $this->dateAccess;
    }
}
