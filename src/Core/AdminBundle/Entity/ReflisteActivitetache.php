<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReflisteActivitetache
 */
class ReflisteActivitetache
{
    /**
     * @var integer
     */
    private $refIntActivitetache;

    /**
     * @var string
     */
    private $activitetache;


    /**
     * Get refIntActivitetache
     *
     * @return integer 
     */
    public function getRefIntActivitetache()
    {
        return $this->refIntActivitetache;
    }

    /**
     * Set activitetache
     *
     * @param string $activitetache
     * @return ReflisteActivitetache
     */
    public function setActivitetache($activitetache)
    {
        $this->activitetache = $activitetache;

        return $this;
    }

    /**
     * Get activitetache
     *
     * @return string 
     */
    public function getActivitetache()
    {
        return $this->activitetache;
    }
}
