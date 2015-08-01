<?php

namespace Grdf\DefaultBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Console\Input\ArrayInput;
use Behat\Behat\Console\BehatApplication;
use Symfony\Component\Console\Output\ConsoleOutput;

abstract class CarmaWebTestCase extends WebTestCase
{

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    protected $client;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $em;

    /**
     * @var \Symfony\Component\HttpKernel\KernelInterface
     */
    protected $kern;

    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->kern = $this->client->getKernel();
        $this->container = $this->client->getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');
    }

    protected function tearDown()
    {
        //Close & unsets
        if (is_object($this->em)) {
            $this->em->getConnection()->close();
            $this->em->close();
        }
        unset($this->em);
        unset($this->container);
        unset($this->kern);
        unset($this->client);
        //Nettoyage des mocks
        //http://kriswallsmith.net/post/18029585104/faster-phpunit
        $refl = new \ReflectionObject($this);
        foreach ($refl->getProperties() as $prop) {
            if (!$prop->isStatic() && 0 !== strpos($prop->getDeclaringClass()->getName(), 'PHPUnit_')) {
                $prop->setAccessible(true);
                $prop->setValue($this, null);
            }
        }
        //Nettoyage du garbage
        if (!gc_enabled()) {
            gc_enable();
        }
        gc_collect_cycles();
        //Parent
        parent::tearDown();
    }

    public function scenariosMeetAcceptanceCriteria($bundleName)
    {
        //
        //Les dossiers de logs sont crees s'ils n'existent pas
        //
        $dirFeatures = 'build/logs/features/'.$bundleName.'/';
        if (!is_dir($dirFeatures)) {
            mkdir($dirFeatures, 0777, true);
        }
        //
        //BehatApplication et config
        //
        $app = new BehatApplication('DEV');
        $app->setAutoExit(false);
        $format = 'junit,html';
        $outputFileDefault = $dirFeatures.','.$dirFeatures.'index.html';
        $outputFileJavascript = $dirFeatures.','.$dirFeatures.'javascript.html';
        //PHPUnit lance avec l'option --verbose (-v) permettra d'afficher dans la console la sortie de Behat :
        if (in_array('--verbose', $_SERVER['argv']) || in_array('-v', $_SERVER['argv'])) {
            $format = 'pretty,'.$format;
            $outputFileDefault = ','.$outputFileDefault;
            $outputFileJavascript = ','.$outputFileJavascript;
        }
        //
        //Le profil Behat : default
        //
        $resultDefault = $app->run(new ArrayInput(array(
            '--ansi' => null,
            '--format' => $format,
            '--out' => $outputFileDefault,
            'features' => '@'.$bundleName
            )), new ConsoleOutput());
        //
        //Le profil Behat : javascript ou javascript_jenkins
        //
        $profile = 'javascript';
        //Si on detecte que les tests sont lances depuis Jenkins, on utilise le profil "javascript_jenkins"
        /* if (strpos(getcwd(), '/var/lib/jenkins/') !== false) {
          $profile = 'javascript_jenkins';
          } */
        $resultJavascript = $app->run(new ArrayInput(array(
            '--ansi' => null,
            '--format' => $format,
            '--out' => $outputFileJavascript,
            '--profile' => $profile,
            'features' => '@'.$bundleName
            )), new ConsoleOutput());
        //Assertion
        $result = $resultDefault + $resultJavascript;
        $this->assertEquals(0, $result, $result." scénario(s) Behat échoue(nt) pour '".$bundleName."', plus d'info disponible dans '".$dirFeatures."' !");
    }

    protected function cleanTable($entityName) 
    {
        $o = $this->em->getRepository($entityName)->findAll();
        foreach ($o as $e) {
            $this->em->remove($e);
        }
        $this->em->flush();
    }
}
