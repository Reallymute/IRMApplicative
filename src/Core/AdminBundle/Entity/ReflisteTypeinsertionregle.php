<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReflisteTypeinsertionregle
 */
class ReflisteTypeinsertionregle
{
    /**
     * @var integer
     */
    private $refIntInsertionregle;

    /**
     * @var string
     */
    private $typeinsertionregle;


    /**
     * Get refIntInsertionregle
     *
     * @return integer 
     */
    public function getRefIntInsertionregle()
    {
        return $this->refIntInsertionregle;
    }

    /**
     * Set typeinsertionregle
     *
     * @param string $typeinsertionregle
     * @return ReflisteTypeinsertionregle
     */
    public function setTypeinsertionregle($typeinsertionregle)
    {
        $this->typeinsertionregle = $typeinsertionregle;

        return $this;
    }

    /**
     * Get typeinsertionregle
     *
     * @return string 
     */
    public function getTypeinsertionregle()
    {
        return $this->typeinsertionregle;
    }
}
