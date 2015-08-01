<?php

namespace Grdf\DefaultBundle\Tests\Controller;

class MetierAdminControllerTest extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{

    public function cleanMetier()
    {
        $ms = $this->em->getRepository('GrdfDefaultBundle:Metier')->findAll();
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
     */
    public function creationMetierOk()
    {
        $this->cleanMetier();
        $this->setGaia();

        $crawler = $this->client->request('GET', '/admin/metier/');
        $this->assertEquals(true, ('Aucun métier' === trim($crawler->filter('div.content table tbody tr td')->text())));

        $crawler = $this->client->click($crawler->filter('table thead a')->eq(0)->link());
        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_metiertype' => array(
                'title' => 'Test Metier'
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Le métier Test Metier a été enregistré !'));
    }

    /**
     * @test
     */
    public function modifMetierOk()
    {
        $this->cleanMetier();
        $this->setGaia();

        $metier = new \Grdf\DefaultBundle\Entity\Metier();
        $metier->setTitle('Test');
        $this->em->persist($metier);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/admin/metier/edit/'.$metier->getId());

        $this->assertEquals(true, ('Test' === trim($crawler->filter('div.content #grdf_defaultbundle_metiertype_title')->attr('value'))));

        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_metiertype' => array(
                'title' => 'Test Metier'
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Le métier Test Metier a été enregistré !'));

        $crawler = $this->client->request('GET', '/admin/metier/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test Metier'));
    }

    /**
     * @test
     */
    public function deleteMetierOk()
    {
        $this->cleanMetier();
        $this->setGaia();

        $metier = new \Grdf\DefaultBundle\Entity\Metier();
        $metier->setTitle('Test');
        $this->em->persist($metier);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/admin/metier/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test'));

        $crawler = $this->client->submit($crawler->filter('.delete')->form(), array(
            'form' => array(
                'id' => $metier->getId()
            )
        ));

        $crawler = $this->client->request('GET', '/admin/metier/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Aucun métier'));
    }

}
