<?php

namespace Grdf\DefaultBundle\Tests\Controller;

use Grdf\DefaultBundle\Entity\Pack;

class PackAdminController extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{
    public $pack;
    
    protected function setUp()
    {
        parent::setUp();
        $this->cleanPack();
        $this->pack = $this->addPack();
    }
    
     public function cleanPack()
    {
        $packs = $this->em->getRepository('GrdfDefaultBundle:Pack')->findAll();
        foreach ($packs as $m) {
            $this->em->remove($m);
        }
        $this->em->flush();
    }
    
     public function addPack()
    {
        $pack = new Pack();
        $application = $this->em->getRepository('GrdfDefaultBundle:Application')->find(1);
        $pack->setTitle("test pack");
        $pack->addApplication($application);
        $this->em->persist($pack);
        $this->em->flush();
        return $pack;
    }

    public function setGaia()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Matthieu');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'GAUTHIER');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'mat.go@grdf.fr');
    }

    /**
     * @test
     * @group pack
     */
    public function testIndexAction()
    {
        $this->setGaia();
        $crawler = $this->client->request('GET', '/admin/pack'); 
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @test
     * @group pack
     * @group pack1
     */
    public function testNewAction()
    {
        $this->setGaia();
        
        $crawler = $this->client->request('GET', '/admin/pack/new/');
        $this->assertEquals(true, ('Ajouter un pack' === trim($crawler->filter('div.content h1')->text())));
        
         $form = $crawler->selectButton('Valider')->form(array(
            'grdf_defaultbundle_packtype[title]' => 'test new pack',
            'grdf_defaultbundle_packtype[applications]' => array('21'),
        ));
        $crawler = $this->client->submit($form);
        
        $this->assertNotEquals(false, strstr($crawler->text(), 'Le pack test new pack a été enregistré !'));
        
        
    }
    
    /**
     * @test
     * @group pack
     * @group pack2
     */
    public function testEditAction()
    {
        $this->setGaia();
        
        $crawler = $this->client->request('GET', '/admin/pack/edit/'.$this->pack->getId());
        
        $form = $crawler->selectButton('Valider')->form(array(
            'grdf_defaultbundle_packtype[title]' => 'test edit pack',
            'grdf_defaultbundle_packtype[applications]' => array('21'),
        ));
        $crawler = $this->client->submit($form);
        $this->assertNotEquals(false, strstr($crawler->text(), 'Le pack test edit pack a été enregistré !'));
    }

    /**
     * @test
     * @group pack
     * @group pack1
     */
    public function deletePackTest()
    {
        $this->cleanPack();
        $this->setGaia();
        $pack = $this->addPack();

        $crawler = $this->client->request('GET', '/admin/pack/');
        //$this->assertNotEquals(false, strstr($crawler->text(), 'Packs (0)'));
        $crawler = $this->client->submit($crawler->selectButton('Supprimer')->form(), array(
            'form' => array(
                'id' => $pack->getId()
            )
        ));

        $crawler = $this->client->request('GET', '/admin/pack/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Aucun pack'));
        $this->assertEquals(0, $this->em->getRepository('GrdfDefaultBundle:Pack')->count());
    }


}
