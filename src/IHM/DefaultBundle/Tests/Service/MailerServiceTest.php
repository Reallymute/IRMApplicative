<?php

namespace Grdf\DefaultBundle\Tests\Service;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;

class MailerServiceTest extends CarmaWebTestCase
{

    /**
     * @test
     * @group service
     * @group service_mailer
     *
     * @expectedException \Swift_RfcComplianceException
     */
    public function testSendWithException()
    {
        $mailer = $this->container->get('grdf.defaultbundle.mailer');
        $mailer->send('exception', 'Subject', 'GrdfDefaultBundle:Mail:layout.html.twig', array(
            'content' => "Bonjour de la CARMA !"
        ));
    }

    /**
     * @test
     * @group service
     * @group service_mailer
     */
    public function testSend()
    {
        $mailer = $this->container->get('grdf.defaultbundle.mailer');
        $failures = $mailer->send('test@test.com', 'Subject', 'GrdfDefaultBundle:Mail:layout.html.twig', array(
            'content' => "Bonjour de la CARMA !"
        ));
        $this->assertTrue(is_array($failures));
        $this->assertCount(0, $failures);
    }

    /**
     * @test
     * @group service
     * @group service_mailer
     */
    public function testSendInCli()
    {
        $mailer = $this->container->get('grdf.defaultbundle.mailer');
        $failures = $mailer->send('test@test.com', 'Subject', 'GrdfDefaultBundle:Mail:layout.html.twig', array(
            'content' => "Bonjour de la CARMA !"
        ), true);
        $this->assertTrue(is_array($failures));
        $this->assertCount(0, $failures);
    }

}
