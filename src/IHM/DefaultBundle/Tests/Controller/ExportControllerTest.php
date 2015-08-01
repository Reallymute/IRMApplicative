<?php
namespace Grdf\DefaultBundle\Tests\Controller;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;
use Grdf\DefaultBundle\Controller\ExportController;

class ExportControllerTest extends CarmaWebTestCase
{
    
    /**
     * @test
     * @group export
     * @group export1
     */
    public function testApplicationsExport()
    {
        ob_start();
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');

        $crawler = $this->client->request('GET', '/export/applications/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/export/applications/', $this->client->getRequest()->getRequestUri());
        ob_end_clean();
    }
    
    /**
     * @test
     * @group export
     * @group expor2
     */
    public function testDemandesExport()
    {
        ob_start();
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $crawler = $this->client->request('GET', '/export/demandes/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/export/demandes/', $this->client->getRequest()->getRequestUri());
        ob_end_clean();
    }
    
    
    /**
     * @test
     * @group export
     * @group export3
     */
    public function testSuggestionsExport()
    {
        ob_start();
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $crawler = $this->client->request('GET', '/export/suggestions/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/export/suggestions/', $this->client->getRequest()->getRequestUri());
        ob_end_clean();
    }
    
    /**
     * @test
     * @group export
     * @group export4
     */
    public function testChartesExport()
    {
        ob_start();
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $crawler = $this->client->request('GET', '/export/chartes/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/export/chartes/', $this->client->getRequest()->getRequestUri());
        ob_end_clean();
    }
}