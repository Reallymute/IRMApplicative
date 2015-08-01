<?php

namespace IHM\RequetesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DetecterControllerTest extends WebTestCase
{
    public function testBpm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/BPM');
    }

    public function testMq()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/MQ');
    }

}
