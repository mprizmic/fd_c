<?php

namespace Fd\BackendBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;

class UnidadEducativaBajaEvent extends Event {

    protected $unidad_educativa;
    protected $oferta_educativa;
    protected $unidad_oferta;
    protected $respuesta;

    public function __construct(UnidadEducativa $unidad_educativa) {
        $this->unidad_educativa = $unidad_educativa;
    }

    public function getUnidadEducativa() {
        return $this->unidad_educativa;
    }
    public function getRespuesta(){
        return $this->respuesta;
    }
    public function setRespuesta($respuesta){
        $this->respuesta = $respuesta;
    }
    public function getOfertaEducativa(){
        return $this->oferta_educativa;
    }
    public function setOfertaEducativa( $oferta_educativa ){
        $this->oferta_educativa = $oferta_educativa;
    }
    public function getUnidadOferta(){
        return $this->unidad_oferta;
    }
    public function setUnidadOferta( $unidad_oferta){
        $this->unidad_oferta = $unidad_oferta;
    }

}