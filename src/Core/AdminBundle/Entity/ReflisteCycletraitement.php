<?php

namespace Core\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReflisteCycletraitement
 */
class ReflisteCycletraitement
{
    /**
     * @var integer
     */
    private $refIntCycletraitement;

    /**
     * @var string
     */
    private $typecycle;

    /**
     * @var string
     */
    private $refIntRegle;


    /**
     * Get refIntCycletraitement
     *
     * @return integer 
     */
    public function getRefIntCycletraitement()
    {
        return $this->refIntCycletraitement;
    }

    /**
     * Set typecycle
     *
     * @param string $typecycle
     * @return ReflisteCycletraitement
     */
    public function setTypecycle($typecycle)
    {
        $this->typecycle = $typecycle;

        return $this;
    }

    /**
     * Get typecycle
     *
     * @return string 
     */
    public function getTypecycle()
    {
        return $this->typecycle;
    }

    /**
     * Set refIntRegle
     *
     * @param string $refIntRegle
     * @return ReflisteCycletraitement
     */
    public function setRefIntRegle($refIntRegle)
    {
        $this->refIntRegle = $refIntRegle;

        return $this;
    }

    /**
     * Get refIntRegle
     *
     * @return string 
     */
    public function getRefIntRegle()
    {
        return $this->refIntRegle;
    }
}
