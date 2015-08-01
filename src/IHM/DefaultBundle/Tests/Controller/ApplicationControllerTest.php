<?php

namespace Grdf\DefaultBundle\Tests\Controller;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;

class ApplicationControllerTest extends CarmaWebTestCase
{

    /**
     * @test
     * @group application
     */
    public function testCatalogueIndexHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $crawler = $this->client->request('GET', '/catalogue/application');
        
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/catalogue/application',$this->client->getRequest()->getRequestUri());
    }
    
    /**
     * @test
     * @group application
     */
    public function testCatalogueIndexRedirectHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $crawler = $this->client->request('GET', '/application');
        
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/catalogue/application',$this->client->getRequest()->getRequestUri());
    }
    
    /**
     * @test
     * @group application
     */
    public function testApplicationsHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200,$this->client->getResponse()->getStatusCode());
        $this->assertEquals('/',$this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group catalogue_application
     */
    public function testCatalogue()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        //Le slug du test
        $slug = $this->to_slug('toutProposition');
        $crawler = $this->client->request('GET', '/catalogue/application/'.$slug);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/catalogue/application/'.$slug, $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group application
     */
    public function getApplicationsWithoutXMLHttpRequestRedirectsToHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('GET', '/application/json/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group application
     */
    public function getApplicationsWithoutMethodGETRedirectsToHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('POST', '/application/json/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group application
     *
     */
    public function getApplicationsReturnsTrue()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('GET', '/application/json/', array(), array(), array(
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ));
        $result = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertInternalType('array', $result, "Le tableau du resultat n'a pas pu etre cree !");
    }

    /**
     * @test
     * @group application
     */
    public function getApplicationsByPackWithoutXMLHttpRequestRedirectsToHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('GET', '/application/pack/json/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group application
     */
    public function getApplicationsByPackWithoutMethodGETRedirectsToHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('POST', '/application/pack/json/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group application
     */
    public function getApplicationsByPackWithoutIdRedirectsToHome()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('GET', '/application/pack/json/', array(), array(), array(
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('/', $this->client->getRequest()->getRequestUri());
    }

    /**
     * @test
     * @group application
     *
     */
    public function getApplicationsByPackReturnsTrue()
    {
        $this->client->setServerParameter('HTTP_SM_UNIVERSALID', 'AA6666');
        $this->client->request('GET', '/application/pack/json/', array('id' => 1), array(), array(
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ));
        $result = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertInternalType('array', $result, "Le tableau du resultat n'a pas pu etre cree !");
    }

    /**
     * Transforme le une chaine de caractères en slug
     * 
     * @param string $string
     * @return string
     */
    public function to_slug($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }

}
