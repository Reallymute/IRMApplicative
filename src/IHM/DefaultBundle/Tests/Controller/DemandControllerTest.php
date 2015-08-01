<?php

namespace Grdf\DefaultBundle\Tests\Controller;

use \Grdf\DefaultBundle\Enum\TypeEnum;

class DemandControllerTest extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{

    /**
     * @test
     * @group pageDemand
     */
    public function countTypeDemand()
    {
        $this->clearCategories();
        //On fait d'abord appel au test pour la création d'une page de demande
        $this->pageCreateDemand();
        $crawler = $this->client->request('GET', '/demand/create/');
        $this->assertEquals(2, $crawler->filter('input[type=radio]')->count());
    }

    /**
     * @test
     * @group pageDemand
     */
    public function pageCreateDemand()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->request('GET', '/demand/create/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/demand/create/', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group pageDemand
     */
    public function pageNewDemand()
    {
        //$this->createCategory();
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand/add/pack');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/demand/add/pack', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group pageDemand
     */
    public function listOfApplicationsMoreOne()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand/add/application');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/demand/add/application', $this->client->getRequest()->getRequestUri());

        $this->assertGreaterThan(1, $crawler->filter('select#grdf_defaultbundle_demandnewtype_applications option')->count());
    }

    /**
     * @test
     * @group pageDemand
     */
    public function listOfMobilitiesMoreOne()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand/add/mobilite');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/demand/add/mobilite', $this->client->getRequest()->getRequestUri());

        $this->assertEquals(0, $crawler->filter('select#grdf_defaultbundle_demandnewtype_applications option')->count());
    }

    /**
     * @test
     * @group mg
     */
    public function listOneDemand()
    {
        $this->clearDemands();
        $this->createXDemand(1);


        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand/');
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());
        $this->assertEquals(false, ('Aucune demande' === trim($crawler->filter('div.content table tbody tr')->text())));
    }

    /**
     * @test
     * @group mg
     */
    public function listMoreThan10Demand()
    {
        $this->clearDemands();
        $this->createXDemand(11);


        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand');
        $this->assertEquals(10, $crawler->filter('div.content table tbody tr')->count());
    }

    /**
     * @test
     * @group mg
     */
    public function deleteDemand()
    {
        $this->clearDemands();
        $this->createXDemand(1);

        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');

        $crawler = $this->client->request('GET', '/demand');
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());

        $crawler = $this->client->click($crawler->filter('div.content table tbody tr a.delete')->eq(0)->link());
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());
        $this->assertEquals(true, ('Aucune demande' === trim($crawler->filter('div.content table tbody tr')->text())));
    }

    /**
     * @test
     * @group mg
     */
    public function searchDemandOk()
    {
        $this->clearDemands();
        $this->createXDemand(1);

        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand');
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());

        $crawler = $this->client->submit($crawler->filter('#searchDemandBtn')->form(), array(
            'grdf_defaultbundle_demandsearchtype' => array(
                'recherche' => 'Matthieu'
            )
        ));
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());
        $this->assertEquals(false, ('Aucune demande' === trim($crawler->filter('div.content table tbody tr')->text())));
    }

    /**
     * @test
     * @group mg
     */
    public function searchDemandKo()
    {
        $this->clearDemands();
        $this->createXDemand(1);

        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand');
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());

        $crawler = $this->client->submit($crawler->filter('#searchDemandBtn')->form(), array(
            'grdf_defaultbundle_demandsearchtype' => array(
                'recherche' => 'Matthieu2'
            )
        ));
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());
        $this->assertEquals(true, ('Aucune demande' === trim($crawler->filter('div.content table tbody tr')->text())));
    }

    /**
     * @test
     * @group mg100
     */
    public function showDemand()
    {
        $this->clearDemands();
        $this->createXDemand(1);

        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $crawler = $this->client->request('GET', '/demand');
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());
        /* $this->assertEquals(false, ('Aucune demande' === trim($crawler->filter('div.content table tbody tr')->text())));

          $crawler = $this->client->click($crawler->filter('div.content table tbody tr a.show')->eq(0)->link());

          $this->assertNotEquals(false, strstr($crawler->filter('div.demand-header h1')->text(),'@toutPrisca'));
          $this->assertNotEquals(false, strstr($crawler->filter('div.demand-header h2')->text(),'Demande n°')); */
    }

    /**
     * @test
     * @group mg
     */
    public function createChoiceDemand()
    {
        // Prepare
        $this->clearDemands();
        $this->clearCategories();

        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Matthieu');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'GAUTHIER');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'mat.go@grdf.fr');
        // Clique new
        $crawler = $this->client->request('GET', '/demand');
        $this->assertEquals(1, $crawler->filter('div.content table tbody tr')->count());
        $this->assertEquals(true, ('Aucune demande' === trim($crawler->filter('div.content table tbody tr')->text())));

        $crawler = $this->client->click($crawler->filter('a.new')->eq(0)->link());
        //$crawler = $this->client->click($crawler->filter('#grdf_defaultbundle_demandcategorytype_continue')->eq(0)->link());

        $crawler = $this->client->submit($crawler->filter('#grdf_defaultbundle_demandcategorytype_continue')->form(), array(
            'grdf_defaultbundle_demandcategorytype' => array('type' => 1)
        ));
        // Send new
        $crawler = $this->client->submit($crawler->filter('#grdf_defaultbundle_demandnewtype_continue')->form(), array(
            'grdf_defaultbundle_demandnewtype' => array(
                'applications' => $this->em->getRepository('GrdfDefaultBundle:Application')->findOneByTitle('@toutPrisca')->getId()
            )
        ));

        // Send type
        $crawler = $this->client->submit($crawler->filter('#grdf_defaultbundle_demandchoicetype_continue')->form(), array(
            'grdf_defaultbundle_demandchoicetype' => array(
                'choice' => 'CREATE'
            )
        ));

        // Send infos
        $this->assertNotEquals(false, strstr($crawler->text(), 'Supprimer brouillon'));

        $form = $crawler->filter('#dde-send-form')->form();
        $values = array(
            'grdf_defaultbundle_generatedformfinaltype' => array(
                '_token' => $form['grdf_defaultbundle_generatedformfinaltype[_token]']->getValue(),
                'entity' => $form['grdf_defaultbundle_generatedformfinaltype[entity]']->getValue(),
                'rows_0' => '0,0',
                'rows_1' => '',
                'rows_2' => '',
            )
        );
        $crawler = $this->client->request($form->getMethod(), $form->getUri(), $values);
        // Confirm
        $this->assertNotEquals(false, strstr($crawler->text(), 'Votre demande est transmise, vous pouvez la suivre dans la liste des demandes en cliquant sur Détail'));
    }

    private function createXDemand($x)
    {
        for ($i = 0; $i < $x; $i++) {
            $this->createDemand();
        }
    }

    private function createDemand()
    {
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

    private function clearDemands()
    {
        $o = $this->em->getRepository('GrdfDefaultBundle:Demand')->findAll();
        foreach ($o as $d) {
            $this->em->remove($d);
        }
        $this->em->flush();
    }

    private function createXCategory($X)
    {
        for ($i = 0; $i < $nb; $i++) {
            $this->createCategory();
        }
    }

    private function createCategory()
    {
        $d = new \Grdf\DefaultBundle\Entity\Type();
        //On envoie le code
        $d->setCode("pack");
        $d->setTitle("Pack " . $this->em->getRepository('GrdfDefaultBundle:Type')->count());

        $this->em->persist($d);
        $this->em->flush();
    }

    private function clearCategories() {
        $this->clearDemands();
        $app = $this->em->getRepository('GrdfDefaultBundle:Application')->findAll();
        $types = $this->em->getRepository('GrdfDefaultBundle:Type')->findAll();
        
        foreach($app as $a) {
            if($a->getType()->getCode() != TypeEnum::CODE_APPLICATION && $a->getType()->getCode() != TypeEnum::CODE_MOBILITE) {
                $this->em->remove($a);
                $this->em->flush();
            }
        }
        
        foreach($types as $type) {
            if($type->getCode() != TypeEnum::CODE_APPLICATION && $type->getCode() != TypeEnum::CODE_MOBILITE) {
                $this->em->remove($type);
                $this->em->flush();
            }
        }
    }
}
