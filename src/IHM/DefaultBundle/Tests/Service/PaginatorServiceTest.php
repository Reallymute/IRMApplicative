<?php

namespace Grdf\DefaultBundle\Tests\Service;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;

class PaginatorServiceTest extends CarmaWebTestCase
{

    private $paginator_service;

    public function setUp()
    {
        parent::setUp();
        $this->paginator_service = $this->container->get('grdf.defaultbundle.paginator');
    }

    /**
     * @test
     * @group service
     * @group paginator_service
     * @group paginator1
     */
    public function getPaginationWithEnoughtEntitiesTest()
    {
        $this->cleanTable('GrdfDefaultBundle:Demand');
        $this->createXDemand(20);
        $entities = $this->em->getRepository('GrdfDefaultBundle:Demand')->findAll();
        
        $request = new Request();
        $request->query->set('page', 1);
        
        $pagination = $this->paginator_service->getPagination($request, $entities, 10);
        $pageEntities = $pagination->getItems();
        
        $this->assertCount(10, $pageEntities);
    }
    
    /**
     * @test
     * @group service
     * @group paginator_service
     * @group paginator2
     */
    public function getPaginationWithLessEntitiesTest() 
    {
        $this->cleanTable('GrdfDefaultBundle:Demand');
        $this->createXDemand(15);
        $entities = $this->em->getRepository('GrdfDefaultBundle:Demand')->findAll();
        
        $request = new Request();
        $request->query->set('page', 2);
        
        $pagination = $this->paginator_service->getPagination($request, $entities, 10);
        $pageEntities = $pagination->getItems();
        
        $this->assertCount(5, $pageEntities);
    }

    private function createXDemand($x)
    {
        for ($i = 0; $i < $x; $i++) {
            $d = new \Grdf\DefaultBundle\Entity\Demand();
            $d->setApplicantGaia('BX2076');
            $d->setApplicantFirstName('Matthieu');
            $d->setApplicantLastName('GAUTHIER');
            $d->setApplicantEmail('matthieu.gauthier@external.grdf.fr');
            $d->setBeneficiaryGaia($d->getApplicantGaia());
            $d->setBeneficiaryFirstName($d->getApplicantFirstName());
            $d->setBeneficiaryLastName($d->getApplicantLastName());
            $d->setBeneficiaryEmail($d->getApplicantEmail());
            $d->setType(\Grdf\DefaultBundle\Enum\DemandTypeEnum::OUT);
            $d->setApplication($this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle('@toutPrisca'));
            

            $this->em->persist($d);
            $this->em->flush();
        }
    }
}
