<?php

namespace Grdf\GaiaBundle\Listener;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\FileCacheReader;
use Core\IRMSecurityBundle\Service;
use Grdf\GaiaBundle\Service\GaiaService;
use Grdf\DefaultBundle\Service\SecurityService;
use Grdf\GaiaBundle\Annotation\RequiresGaia;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * RequestListener est une classe déclarée en tant que Service. La
 * déclaration est faite dans le fichier service.xml présent dans le dossier 
 * Resources\Config du Bundle ayant le dossier 'GaiaBundle'
 */

class RequestListener
{

    /**
     * @var \Doctrine\Common\Annotations\FileCacheReader 
     */
    private $reader;

    /**
     * @var \Grdf\GaiaBundle\Service\GaiaService
     */
    private $gaia;

    /**
     * @var \Core\IRMSecurityBundle\Service
     */
    private $security;
//    public function __construct(Reader $reader, GaiaService $gaia, IRMSecurityService $security)
//  MARC LAST WORKED HERE 19 AUG 
//    public function __construct( ContainerInterface $conty)
    //public function __construct(Reader $reader, GaiaService $gaia)
    public function __construct(FileCacheReader $reader, GaiaService $gaia,  $security)
   {
        $this->reader = $reader;
        $this->gaia = $gaia;
        $this->security = $security;
    }

    public function onKernelRequest(GetResponseEvent $event) // Not Fired by behat!
    {
        // Uncomment these lines if you want to restrict the entire application to Gaia
        //if( strlen($event->getRequest()->headers->get('sm-universalid')) === 0 ) {
        //    throw new \Exception('GAIA non détecté !', 8700);
        //}
    }

    public function onKernelException(GetResponseForExceptionEvent $event) // Not Fired by behat!
    {
        $exception = $event->getException();
        if (in_array($exception->getCode(), array(8700, 8701, 8702))) {
            $response = new \Symfony\Component\HttpFoundation\Response('403 ('.$exception->getCode().') : '.$exception->getMessage(), 403);
            $event->setResponse($response);
        }
    }
/**
 *  Notes de Marc : onFilterController est un membre de classe qui est automatiquement
 * appelé par le moteur symfony2 (la classe doit avoir été déclarée en Service et doit être
 * instancié dans le Container de symfony) en amont de chaque traitement de requête
 * Dans ce cas particulier, le filtre va employer un autre Service, déclaré dans 
 * 'GaiaService.php' pour tester la présence de certains codes qui sont la preuve de
 * l'autorisation de l'originaire de la requête.
 * @param FilterControllerEvent $event
 * @return type
 * @throws \Exception
 */
    public function onFilterController(FilterControllerEvent $event)
    {

// Marc inserted this to test if it's being used
                throw new \Exception('SUCCES : Nous sommes dans onFilterController !', 8701);
        
//Return if no controller
        if (!is_array($controller = $event->getController())) {
            return;
        }

        list($object, $method) = $controller;

        // the controller could be a proxy, e.g. when using the JMSSecuriyExtraBundle or JMSDiExtraBundle
        $className = ClassUtils::getClass($object);

        $reflectionClass = new \ReflectionClass($className);
        $reflectionMethod = $reflectionClass->getMethod($method);

        $allAnnotations = $this->reader->getMethodAnnotations($reflectionMethod);

        $gaiaAnnotations = array_filter($allAnnotations, function($annotation) {
                return $annotation instanceof RequiresGaia;
        });

        foreach ($gaiaAnnotations as $gaiaAnnotation) {
            // ... verify
            // throw an exception, catch it using an exception listener
            // then in the exception listener, create a RedirectResponse or something
            // and set it on the $event object
            $gaia = $this->gaia->getGaiaValues('gaia');
            if (strlen($gaia) === 0) {
                throw new \Exception('GAIA non détecté !', 8701);
            }
            if (($gaiaAnnotation->value === 'admin' && $this->security->isAdmin() === false) ||
                ($gaiaAnnotation->value === 'admin_app' && $this->security->isAdminOrAdminApp() === false)) {
                throw new \Exception("Vous n'avez pas les droits nécessaires !", 8702);
            }
        }
    }

}