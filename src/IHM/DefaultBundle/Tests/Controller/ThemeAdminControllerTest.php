<?php

namespace Grdf\DefaultBundle\Tests\Controller;

class ThemeAdminControllerTest extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{

    public function cleanMetier()
    {
        $ms = $this->em->getRepository('GrdfDefaultBundle:Categorie')->findAll();
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
    public function creationThemeOk()
    {
        $this->cleanMetier();
        $this->setGaia();

        $crawler = $this->client->request('GET', '/admin/categorie/');
        $this->assertEquals(true, ('Aucun thème' === trim($crawler->filter('div.content table tbody tr td')->text())));

        $crawler = $this->client->click($crawler->filter('table thead a')->eq(0)->link());
        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_categorietype' => array(
                'title' => 'Test Metier',
                'color' => 'GRIS'
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Le thème Test Metier a été enregistré !'));
    }

    /**
     * @test
     */
    public function modifThemeOk()
    {
        $this->cleanMetier();
        $this->setGaia();

        $metier = new \Grdf\DefaultBundle\Entity\Categorie();
        $metier->setTitle('Test');
        $this->em->persist($metier);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/admin/categorie/edit/'.$metier->getId());

        $this->assertEquals(true, ('Test' === trim($crawler->filter('div.content #grdf_defaultbundle_categorietype_title')->attr('value'))));

        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_categorietype' => array(
                'title' => 'Test Metier',
                'color' => 'GRIS'
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'Le thème Test Metier a été enregistré !'));

        $crawler = $this->client->request('GET', '/admin/categorie/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test Metier'));
    }

    /**
     * @test
     */
    public function deleteThemeOk()
    {
        $this->cleanMetier();
        $this->setGaia();

        $metier = new \Grdf\DefaultBundle\Entity\Categorie();
        $metier->setTitle('Test');
        $this->em->persist($metier);
        $this->em->flush();

        $crawler = $this->client->request('GET', '/admin/categorie/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Test'));

        $crawler = $this->client->submit($crawler->filter('.delete')->form(), array(
            'form' => array(
                'id' => $metier->getId()
            )
        ));

        $crawler = $this->client->request('GET', '/admin/categorie/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'Aucun thème'));
    }

}
