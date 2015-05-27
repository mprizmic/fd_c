<?php

namespace Fd\BackendBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Fd\BackendBundle\Event\UnidadEducativaBajaEvent;
use Fd\BackendBundle\Event\BackendEvents;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;

class UnidadOfertaUEBajaListener {

    private $em;
//    private $uo_handler;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * FALTA no tienen lista la localizacion. Por el momento se los anula hasta que se revise
     * 
     * Cuando se baja una unidad educativa se baja la unidad_oferta
     * Se presupone que ya está creada la oferta_educativa
     */
    public function onUnidadEducativaBaja(UnidadEducativaBajaEvent $event) {
//        $unidad_educativa = $event->getUnidadEducativa();
//        
//        //recupero la unidad_oferta
//        $ofertas = $unidad_educativa->getOfertas();
//        
//        $uo_handler = new UnidadOfertaHandler($this->em, $unidad_educativa->getNivel() );
//        
//        $respuesta = $uo_handler->eliminarAll($unidad_educativa);
//        
//        $event->setRespuesta($respuesta);
        
//        return $event;
    }

}
