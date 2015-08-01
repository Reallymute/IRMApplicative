<?php

namespace Grdf\DefaultBundle\Tests\Controller;

class AdministratorAdminControllerTest extends \Grdf\DefaultBundle\Tests\CarmaWebTestCase
{

    public function cleanAdministrator()
    {
        $ms = $this->em->getRepository('GrdfGaiaBundle:User')->findAll();
        foreach ($ms as $m) {
            if( $m->getGaia() != 'BX2076') {
                $this->em->remove($m);
            }
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
    public function creationAdministratorOk()
    {
        $this->cleanAdministrator();
        $this->setGaia();

        $crawler = $this->client->request('GET', '/admin/administrator/');
        $this->assertEquals(1, count($crawler->filter('div.content table tbody tr')));

        $crawler = $this->client->click($crawler->filter('table thead a')->eq(0)->link());
        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_administratortype' => array(
                'gaia' => 'XX0007',
                'firstName' => 'MAt',
                'lastName' => 'GO',
                'email' => 'mat@go.fr',
                'group' => 'admin'
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'L\'administrateur XX0007 a été enregistré !'));
    }

    /**
     * @test
     */
    public function modifAdministratorOk()
    {
        $this->cleanAdministrator();
        $this->setGaia();

        $metier = $this->em->getRepository('GrdfGaiaBundle:User')->findOneBy(array('gaia'=>'BX2076'));
        
        $crawler = $this->client->request('GET', '/admin/administrator/edit/'.$metier->getGaia());

        //$this->assertEquals(true, ('Test' === trim($crawler->filter('div.content #grdf_defaultbundle_metiertype_title')->attr('value'))));

        $crawler = $this->client->submit($crawler->filter('.valid')->form(), array(
            'grdf_defaultbundle_administratortype' => array(
                'firstName' => 'MAt',
                'lastName' => 'GO',
                'email' => 'mat@go.fr',
                'group' => 'admin'
            )
        ));
        $this->assertNotEquals(false, strstr($crawler->text(), 'L\'administrateur BX2076 a été enregistré !'));

        $crawler = $this->client->request('GET', '/admin/administrator/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'MAt'));
    }

    /**
     * @test
     */
    public function deleteAdministratorOk()
    {
        $this->cleanAdministrator();
        $this->setGaia();

        $group = $this->em->getRepository('GrdfGaiaBundle:Group')->findOneBy(array('id'=>'admin'));
        
        $u = new \Grdf\GaiaBundle\Entity\User();
        $u->setGaia('XX0008')->setGroup($group);
        $this->em->persist($u);
        $this->em->flush();
        

        $crawler = $this->client->request('GET', '/admin/administrator/');
        $this->assertNotEquals(false, strstr($crawler->text(), 'XX0008'));
        
        $crawler = $this->client->submit($crawler->filter('.delete')->form(), array(
            'form' => array(
                'id' => 'XX0008'
            )
        ));

        $crawler = $this->client->request('GET', '/admin/administrator/');
        $this->assertEquals(false, strstr($crawler->text(), 'XX0008'));
    }

}
