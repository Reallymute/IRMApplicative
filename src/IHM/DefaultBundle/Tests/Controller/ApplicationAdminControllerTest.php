<?php

namespace Grdf\DefaultBundle\Tests\Controller;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;

class ApplicationAdminControllerTest extends CarmaWebTestCase
{

    /**
     * @test
     * @group admin_application
     */
    public function testApplicationsAdmin()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Dominick');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'Makome');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'dominick.makome@grdf.fr');
        
        $crawler = $this->client->request('GET', '/admin/application/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertGreaterThan($actual = 2,$crawler->filter($selector='table.table.table-striped tbody tr')->count());
    }
    
    /**
     * Teste si la page du formulaire répond
     * @test
     * @group admin_application
     */
    public function formApplicationAdmin()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'BX2076');
        $this->client->setServerParameter('HTTP_GAIA_PRENOM', 'Dominick');
        $this->client->setServerParameter('HTTP_GAIA_NOM', 'Makome');
        $this->client->setServerParameter('HTTP_GAIA_EMAIL', 'dominick.makome@grdf.fr');
        
        $crawler = $this->client->request('GET', '/admin/application/new/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
