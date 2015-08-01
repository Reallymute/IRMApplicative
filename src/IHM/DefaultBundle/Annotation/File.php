<?php

namespace Grdf\DefaultBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * File
 * 
 * @Annotation
 */
class File extends Annotation
{

    public $web = false;
    
    static public function getClassName()
    {
        return get_called_class();
    }

}
