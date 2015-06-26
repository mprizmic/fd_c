<?php

namespace Fd\EstablecimientoBundle\Annotation;

/**
 * @Annotation
 * @Attributes({
 *      @Attribute("filename", type="string", required=true)
 * })
 */
class DownloadAs {

    public $filename;
    
}
