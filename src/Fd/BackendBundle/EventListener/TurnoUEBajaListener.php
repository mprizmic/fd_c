<?php

namespace Fd\BackendBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Fd\BackendBundle\Event\UnidadEducativaBajaEvent;
use Fd\BackendBundle\Event\BackendEvents;

class TurnoUEBajaListener {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Cuando se crea una unidad educativa se crea la unidad_oferta
     * Se presupone que ya está creada la oferta_educativa
     */
    public function onUnidadEducativaBaja(UnidadEducativaBajaEvent $event) {
        $unidad_educativa = $event->getUnidadEducativa();
        
        //se crea el handler
        $turno_handler = new TurnoHandler($unidad_educativa, $this->em);
        
        //devuelve el resultadod de la operacion
        $respuesta = $turno_handler->eliminar();
        
        //el evento porta la respuesta del la operacion
        $event->setRespuesta( $respuesta );        
    }

}
