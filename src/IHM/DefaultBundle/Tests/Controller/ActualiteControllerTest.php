<?php

namespace Grdf\DefaultBundle\Tests\Controller;

class ActualiteControllerTest extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{

    public function cleanActualites()
    {
        $as = $this->em->getRepository('GrdfDefaultBundle:Actualite')->findAll();
        foreach ($as as $a) {
            $this->em->remove($a);
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
    
    private function createActualite() {
        $a = new \Grdf\DefaultBundle\Entity\Actualite();
        $a->setTitle('Actualite ' . $this->em->getRepository('GrdfDefaultBundle:Actualite')->count());
        $a->setDescription('Desc');
        $a->setPriority(0);
        
        $this->em->persist($a);
        $this->em->flush();
        
        return $a;
    }
    
    /**
     * @test
     * @group actualities
     * @group act1
     */
    public function creationActualiteTest()
    {
        $this->cleanActualites();
        $this->setGaia();

        $crawler = $this->client->request('GET', '/admin/actualite/');
        $this->assertEquals(true, ('Aucune actualité' === trim($crawler->filter('div.content table tbody tr td')->text())));

        $crawler = $this->client->click($crawler->selectLink('Créer une actualite')->link());
        $crawler = $this->client->submit($crawler->selectButton('Valider')->form(), array(
            'grdf_defaultbundle_actualite[title]' => 'Test',
            'grdf_defaultbundle_actualite[description]' => 'Description Test',
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test'));
        $this->assertEquals(1, $this->em->getRepository('GrdfDefaultBundle:Actualite')->count());
    }

    /**
     * @test
     * @group actualities
     */
    public function modifActualiteTest()
    {
        $this->cleanActualites();
        $this->setGaia();
        $actu = $this->createActualite();

        $crawler = $this->client->request('GET', '/admin/actualite/update/' . $actu->getId());

        $this->assertEquals(true, ('Actualite 0' === trim($crawler->filter('div.content #grdf_defaultbundle_actualite_title')->attr('value'))));

        $crawler = $this->client->submit($crawler->selectButton('Valider')->form(), array(
            'grdf_defaultbundle_actualite[title]' => 'Test',
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test'));

        $crawler = $this->client->request('GET', '/admin/actualite/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test'));
    }

    /**
     * @test
     * @group actualities
     */
    public function deleteActualiteTest()
    {
        $this->cleanActualites();
        $this->setGaia();
        $this->createActualite();

        $crawler = $this->client->request('GET', '/admin/actualite/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Actualite 0'));

        $crawler = $this->client->submit($crawler->selectButton('Supprimer')->form());

        $crawler = $this->client->request('GET', '/admin/actualite/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Aucune actualité'));
        $this->assertEquals(0, $this->em->getRepository('GrdfDefaultBundle:Actualite')->count());
    }

}
