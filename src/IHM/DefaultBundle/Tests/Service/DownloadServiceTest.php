<?php

namespace Grdf\DefaultBundle\Tests\Service;

use Grdf\DefaultBundle\Tests\CarmaWebTestCase;

class DownloadServiceTest extends CarmaWebTestCase
{

    private $download_service;

    public function setUp()
    {
        parent::setUp();
        $this->download_service = $this->container->get('grdf.defaultbundle.download');
    }

    /**
     * @test
     * @group download_service
     * @group service
     */
    public function getStreamedResponseTest()
    {
        $this->createTestFile("Test Content", '/var/www/app/download.test');
        $path = $this->container->get('grdf.defaultbundle.crypt')->getEncryptedString('/download.test');

        ob_start();
        $this->download_service->getStreamedResponse($path)->sendContent();
        $content = ob_get_contents();
        ob_end_clean();

        $this->assertEquals("Test Content", trim($content));
        
        unlink('/var/www/app/download.test');
    }

    private function createTestFile($content, $path)
    {
        $handle = fopen($path, 'w');
        fwrite($handle, $content);
        fclose($handle);

        return $path;
    }

}
