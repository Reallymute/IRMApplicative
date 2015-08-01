<?php

namespace Grdf\DefaultBundle\Tests\Service;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;
use Grdf\DefaultBundle\Entity\Demand;
use Grdf\DefaultBundle\Enum\DemandStatusEnum;

class SecurityServiceTest extends CarmaWebTestCase
{
    
    /**
     * @test
     * @group security
     * @group security1
     */
    public function testIsGrantedToProcess()
    {
        //Nouvelle demande
        $demand = new Demand();
        //On récupère le service security
        $security = $this->container->get('grdf.defaultbundle.security');
        //On récupère le service 
        
        $this->assertNotEquals(true,$security->hasDemandStatus($demand,array(DemandStatusEnum::TO_VALIDATE)));
        //Ensuite on rend la demande à valider
        $demand->setStatus(DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));
        //On voit maintenant si c'est égal
        $this->assertEquals(true,$security->hasDemandStatus($demand,array(DemandStatusEnum::TO_VALIDATE)));
        //On teste maintenant si la demande à des valideurs, operateurs etc...
        $this->assertNotEquals(true, $security->isValideur($demand));
        $this->assertNotEquals(true, $security->isOperateur($demand));
    }
}
