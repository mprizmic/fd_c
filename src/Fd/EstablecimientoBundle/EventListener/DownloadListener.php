<?php

namespace Fd\EstablecimientoBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\Annotation\AbstractControllerAnnotationListener;

class DownloadListener extends AbstractControllerAnnotationListener {

    protected function getAnnotationClass() {
        return 'Fd\EstablecimientoBundle\Annotation\DownloadAs';
    }

    /**
     * Will only be called if an annotation of the class returned by
     * getAnnotationClass() was found
     */
    protected function processAnnotation($annotation, FilterControllerEvent $event) {
        $event->getRequest()->attributes->set(
                '_download_as_filename', $annotation->filename
        );
    }

    public function onKernelResponse(FilterResponseEvent $event) {

        $downloadAsFilename = $event
                ->getRequest()
                ->attributes
                ->get('_download_as_filename');

        if ($downloadAsFilename === null) {
            return;
        }

        $response = $event->getResponse();

        $dispositionHeader = $response
                ->headers
                ->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, $downloadAsFilename
        );
        $response
                ->headers
                ->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        
        $response
                ->headers
                ->set('Content-Disposition', $dispositionHeader);

        // If you are using a https connection, you have to set those two headers for compatibility with IE <9
        $response
                ->headers
                ->set('Pragma', 'public');
        
        $response
                ->headers
                ->set('Cache-Control', 'maxage=1');        
    }

}
