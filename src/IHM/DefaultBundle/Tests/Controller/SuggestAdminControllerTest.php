<?php

namespace Grdf\DefaultBundle\Tests\Controller;

use Grdf\DefaultBundle\Entity\SuggestObject;

class SuggestAdminControllerTest extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{
    
    public function setUp()
    {
        parent::setUp();
        $this->cleanSuggestObject();
        $this->createSuggestObject('test', 'test@test.fr');
    }

    public function cleanSuggestObject()
    {
        $this->cleanSuggest();
        $suggestObject = $this->em->getRepository('GrdfDefaultBundle:SuggestObject')->findAll();
        foreach ($suggestObject as $m) {
            $this->em->remove($m);
        }
        $this->em->flush();
    }
    
    public function createSuggestObject($title, $bal)
    {
        $object = new SuggestObject();
        $object->setTitle($title);
        $object->setBal($bal);
        $object->setOnTop(false);
        
        $this->em->persist($object);
        $this->em->flush();
        
        return $object;
    }
    
    public function cleanSuggest()
    {
        $ms = $this->em->getRepository('GrdfDefaultBundle:Suggest')->findAll();
        foreach ($ms as $m) {
            $this->em->remove($m);
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

    /**
     * @test
     * @group suggest
     */
    public function creationSuggestOk()
    {
        $this->cleanSuggest();
        $this->setGaia();

        $crawler = $this->client->request('GET', '/suggestion/');
        $this->assertEquals(true, ('Aucune suggestion' === trim($crawler->filter('div.content table tbody tr td')->text())));

        $crawler = $this->client->click($crawler->filter('table thead a')->eq(0)->link());
        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_suggesttype' => array(
                'description' => 'Test Metier',
                'status' => 'SUBMIT',
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Votre suggestion a été ajoutée !'));
    }

    /**
     * @test
     * @group suggest
     */
    public function modifSuggestOk()
    {
        $this->cleanSuggest();
        $this->setGaia();

        $metier = new \Grdf\DefaultBundle\Entity\Suggest();
        $metier->setObject($this->em->getRepository('GrdfDefaultBundle:SuggestObject')->findOneBy(array('title' => 'test')));
        $metier->setDescription('Test');
        $metier->setStatus('SUBMIT');
        $metier->setGaia('BX2076');
        $metier->setEmail('e@e.fr')->setFirstName('F')->setLastName('L');
        $this->em->persist($metier);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/suggestion/show/'.$metier->getId());
        $crawler = $this->client->click($crawler->filter('.suggest-context a')->eq(0)->link());
        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_suggesttype' => array(
                'description' => 'Test Metier modif',
                'status' => 'SUBMIT',
            )
        ));

        $this->assertNotEquals(false, strstr($crawler->text(), 'La suggestion a été modifiée !'));
    }

}
