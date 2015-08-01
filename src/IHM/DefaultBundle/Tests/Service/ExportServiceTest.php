<?php

namespace Grdf\DefaultBundle\Tests\Service;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;

class ExportServiceTest extends CarmaWebTestCase
{
    private $exportService;

    public function setGaia()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Matthieu');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'GAUTHIER');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'mat.go@grdf.fr');
    }
    
    public function setUp()
    {
        parent::setUp();
        $this->exportService = $this->container->get('grdf.defaultbundle.export');
    }

    /**
     * @test
     * @group service
     * @group export_service
     */
    public function getStreamedResponseForApplicationsTest()
    {
        ob_start();
        $this->exportService->getStreamedResponseForApplications()->sendContent();        
        $content = ob_get_contents();        
        ob_end_clean();
        
        $this->containsAllApplications($content);
    }

    private function containsAllApplications($content)
    {
        $applications = $this->em->getRepository('GrdfDefaultBundle:Application')->findAll();
        $util = $this->container->get('grdf.defaultbundle.util');
        
        foreach($applications as $app) {
            $title = $util->convertUTF8ToLatin1($app->getTitle());
            $this->assertRegExp('%' . preg_quote($title) . '%', $content); // On teste la presence du titre
        }
    }
    
    /**
     * @test
     * @group service
     * @group export_service
     */
    public function getStreamedResponseForSuggestionsTest() {
        $this->cleanTable('GrdfDefaultBundle:Suggest');
        $suggests = $this->createXSuggests(5);
        
        ob_start();
        $this->exportService->getStreamedResponseForSuggestions()->sendContent();        
        $content = ob_get_contents();        
        ob_end_clean();
        
        foreach($suggests as $k => $s) {
            $this->assertRegExp('%' . $s->getId() . '%', $content); // On teste la presence de l'id
        }
    }
 
    /**
     * @test
     * @group service
     * @group export_service
     */
    public function getStreamedResponseForDemandesTest() {
        $this->cleanTable('GrdfDefaultBundle:Demand');
        $dmds = $this->createXDemand(5);
        
        ob_start();
        $this->exportService->getStreamedResponseForDemandes()->sendContent();        
        $content = ob_get_contents();        
        ob_end_clean();
        
        foreach($dmds as $d) {
            $this->assertRegExp('%' . $d->getId() . '%', $content); // On teste l'id
        }        
    }
    
    private function createXSuggests($nb)
    {        
        $suggests = array();
        for($i = 0; $i < $nb; $i++) {
            $suggest = new \Grdf\DefaultBundle\Entity\Suggest();
            $suggest->setDescription("Description");
            $suggest->setGaia("BF5151");
            $suggest->setEmail('e@e.fr')->setFirstName('F')->setLastName('L');
            
            $this->em->persist($suggest);
            $this->em->flush();
            $sugests[] = $suggest;
        }
        return $sugests;
    }
    
    private function createXDemand($x)
    {
        $dmds = array();
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
            $dmds[] = $d;
        }
        return $dmds;
    }
}
