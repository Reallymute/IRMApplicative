<?php

namespace Grdf\DefaultBundle\Tests\Controller;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;
use Grdf\DefaultBundle\Enum\DemandStatusEnum;
use Grdf\DefaultBundle\Entity\Demand;

class DashboardControllerTest extends CarmaWebTestCase
{
    /**
     * @test
     * @group dashboard
     */
    public function testDashboardHome()
    {
        $this->setGaia();
        $crawler = $this->client->request('GET', '/dashboard/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/dashboard/', $this->client->getRequest()->getRequestUri());
    }
    
    /**
     * @test
     * @group dashboard
     */
    public function dashboardDemandTest()
    {
        $this->setGaia();
        $this->clearDemand();
        $this->createDemand('@toutPrisca', DemandStatusEnum::getKey(DemandStatusEnum::DRAFT));
        $this->createDemand('ATLAS', DemandStatusEnum::getKey(DemandStatusEnum::TO_ANALYZE));
        $this->createDemand('ATLAS', DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));
        $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));
        $this->createDemand('RAPSODIE', DemandStatusEnum::getKey(DemandStatusEnum::TO_VALIDATE));        
        
        $crawler = $this->client->request('GET', '/dashboard/');
        
        // Total @ToutPrisca + nb demande @ToutPrisca Brouillon + nb demande ATLAS A Analyser + nb demande ATLAS A Valider
        // + Total Brouillon + Total A Analyser
        $this->assertEquals(6, substr_count($crawler->filter('div.content div#demands table tbody')->text(), '1'));
        // Total Rapsodie + demande Rapsodie A Valider + Total ATLAS
        $this->assertEquals(3, substr_count($crawler->filter('div.content div#demands table tbody')->text(), '2'));  
        // Total des demandes A Valider
        $this->assertEquals(1, substr_count($crawler->filter('div.content div#demands table tbody')->text(), '3'));
        // Total complet
        $this->assertEquals(1, substr_count($crawler->filter('div.content div#demands table tbody')->text(), '5')); 
    }
    
    /**
     * @test
     * @group dashboard
     */
    public function dashboardAlertTest()
    {
        $this->setGaia();
        $this->clearDemand();
        $this->prepareDemandsWithAlert();                
        
        $crawler = $this->client->request('GET', '/dashboard/');
        
        // @ToutPrisca : AlerteToValidate Admin  | Atlas : AlertToProcess Admin +  AlertToProcess POA | Rapsodie : 1 AlertToAnalyse Admin
        $this->assertEquals(4, substr_count($crawler->filter('div.content div#alertes table tbody')->text(), '1'));
        // Rapsodie : 2 AlertToAnalyze POA
        $this->assertEquals(1, substr_count($crawler->filter('div.content div#alertes table tbody')->text(), '2'));  
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
        $dmds[] = $this->createDemand('ATLAS', DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS));
        $dmds[] = $this->createDemand('ATLAS', DemandStatusEnum::getKey(DemandStatusEnum::TO_PROCESS));
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
    
    public function setGaia()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Matthieu');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'GAUTHIER');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'mat.go@grdf.fr');
    }
}