<?php

namespace Fd\BackendBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Fd\BackendBundle\Event\UnidadEducativaNuevaEvent;
use Fd\BackendBundle\Event\BackendEvents;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;

class UnidadOfertaUENuevaListener {

    private $em;
//    private $uo_handler;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * FALTA no tienen lista la localizacion. Por el momento se los anula hasta que se revise
     * 
     * 
     * Cuando se crea una unidad educativa se crea la unidad_oferta
     * Se presupone que ya está creada la oferta_educativa
     */
    public function onUnidadEducativaNueva(UnidadEducativaNuevaEvent $event) {
        
//        $unidad_educativa = $event->getUnidadEducativa();
//        
//        $uo_handler = new UnidadOfertaHandler($this->em );
//        
//        $unidad_oferta = $uo_handler->crear($unidad_educativa);
//        
//        $event->setUnidadOferta($unidad_oferta);
        
//        return $event;
    }

}
