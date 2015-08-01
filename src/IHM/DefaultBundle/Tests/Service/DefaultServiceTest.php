<?php

namespace Grdf\DefaultBundle\Tests\Service;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;

use Grdf\DefaultBundle\Enum\DemandStatusEnum;
use Grdf\DefaultBundle\Entity\Demand;

class DefaultServiceTest extends CarmaWebTestCase
{
    public function setGaia()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Matthieu');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'GAUTHIER');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'mat.go@grdf.fr');
    }
    
    /**
     * @test
     * @group service
     * @group default_service
     */
    public function getApplicationTest()
    {
        $this->setGaia();
        $defautService = $this->container->get('grdf.defaultbundle.service.default');
        
        $applications = $defautService->getApplications();
        $countAppTotal = count($this->em->getRepository('GrdfDefaultBundle:Application')->findByDemandTypeOrderedByTitle());
        
        $this->assertEquals($countAppTotal, count($applications));
    }

    /**
     * @test
     * @group service
     * @group default_service
     */
    public function getStatsDemandsByApplicationTest() 
    {
        $defautService = $this->container->get('grdf.defaultbundle.service.default');
        $this->clearDemand();
        $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));
        $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));
        $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS));
        $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS));
        $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE));
        
        $totalByStatus = array();
        $application = $this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle('@toutPrisca');
        $statsPrisca = $defautService->getStatsDemandsByApplication($application, null, null, $totalByStatus);
        
        $application = $this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle('RAPSODIE');
        $statsRapsodie = $defautService->getStatsDemandsByApplication($application, null, null, $totalByStatus);
        
        $this->assertEquals(2, $statsPrisca[DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE)]);
        $this->assertEquals(1, $statsPrisca[DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS)]);
        $this->assertEquals(0, $statsPrisca[DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE)]);
        $this->assertEquals(3, $statsPrisca[''], 'Il y a 3 demandes ouvertes pour l\'application @toutPrisca');
        
        $this->assertEquals(1, $statsRapsodie[DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS)]);
        $this->assertEquals(1, $statsRapsodie[DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE)]);
        $this->assertEquals(2, $statsRapsodie[''], 'Il y a 2 demandes ouvertes pour l\'application @toutPrisca');
        
        $this->assertEquals(2, $totalByStatus[DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS)]);
        $this->assertEquals(5, $totalByStatus[''], 'Il y a 2 demandes ouvertes');
    }

    /**
     * @test
     * @group service
     * @group default_service
     */
    public function getStatsAlertByApplicationTest() 
    {
        $defautService = $this->container->get('grdf.defaultbundle.service.default');
        $this->clearDemand();
        $this->prepareDemandsWithAlert();
        
        $alertsPrisca = $defautService->getStatsAlertByApplication($this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle('@toutPrisca'));        
        $alertsRapsodie = $defautService->getStatsAlertByApplication($this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle('RAPSODIE'));
        
        $this->assertEquals(1, $alertsPrisca['alertToValidateAdmin']);
        $this->assertEquals(1, $alertsPrisca['alertToProcessAdmin']);
        $this->assertEquals(1, $alertsPrisca['alertToProcessPOA']);
        $this->assertEquals(0, $alertsPrisca['alertToAnalyzeAdmin']);
        $this->assertEquals(2, $alertsRapsodie['alertToAnalyzePOA']);
        $this->assertEquals(1, $alertsRapsodie['alertToAnalyzeAdmin']);
    }    
    
    private function clearDemand() {
        $dmds = $this->em->getRepository('GrdfDefaultBundle:Demand')->findAll();
        foreach ($dmds as $dmd) 
        {
            $this->em->remove($dmd);
        }
        $this->em->flush();
    }
    
    private function createDemand($appName = '@toutPrisca', $statusKey = false) {
        if($statusKey === false) {
            $statusKey = DemandStatusEnum::getKey(DemandStatusEnum::DRAFT);
        }
        
        $d = new Demand();
        $d->setApplicantGaia('BX2076');
        $d->setApplicantFirstName('Matthieu');
        $d->setApplicantLastName('GAUTHIER');
        $d->setApplicantEmail('matthieu.gauthier@external.grdf.fr');
        $d->setBeneficiaryGaia($d->getApplicantGaia());
        $d->setBeneficiaryFirstName($d->getApplicantFirstName());
        $d->setBeneficiaryLastName($d->getApplicantLastName());
        $d->setBeneficiaryEmail($d->getApplicantEmail());
        $d->setType(\Grdf\DefaultBundle\Enum\DemandTypeEnum::CHOICE);
        $d->setStatus($statusKey);
        $d->setApplication($this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle($appName));

        $this->em->persist($d);
        $this->em->flush();
        
        return $d;
    }
    
    private function prepareDemandsWithAlert() {
        $dmds = array();
        $dmds[] = $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));
        $dmds[] = $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS));
        $dmds[] = $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS));
        $dmds[] = $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE));
        $dmds[] = $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE)); 
        $dmds[] = $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE)); 
        
        $dmds[0]->getLogAlert()->setAlertToValidateAdmin(1)->setUpdatedAt(new \DateTime());
        $dmds[1]->getLogAlert()->setAlertToProcessAdmin(1)->setUpdatedAt(new \DateTime());
        $dmds[2]->getLogAlert()->setAlertToProcessPOA(1)->setUpdatedAt(new \DateTime());
        $dmds[3]->getLogAlert()->setAlertToAnalyzePOA(1)->setUpdatedAt(new \DateTime());
        $dmds[4]->getLogAlert()->setAlertToAnalyzePOA(1)->setUpdatedAt(new \DateTime()); 
        $dmds[5]->getLogAlert()->setAlertToAnalyzeAdmin(1)->setUpdatedAt(new \DateTime()); 
        
        foreach ($dmds as $dmd) {
            $this->em->persist($dmd);
        }
        $this->em->flush();
    }
}
