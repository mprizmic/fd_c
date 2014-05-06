<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimietoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaInicialHandler;
use Fd\EstablecimientoBundle\Model\UnidadOfertaTerciarioHandler;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\TablaBundle\Entity\Nivel;

class UnidadOfertaHandler {

    protected $em;
    protected $strategy;
    protected $strategy_instance;
    protected $nivel;
//    private $unidad_educativa;
//    private $unidad_oferta;

    public function __construct(EntityManager $em, $nivel ) {

        $this->em = $em;
//        $this->unidad_educativa = $unidad_educativa;
//        $nivel = $unidad_educativa->getNivel();
        $strategy = $nivel->getCrearUOClass();
        $strategy_instance = new $strategy($em);
        $this->strategy_instance = $strategy_instance;
        
        $this->nivel = $nivel;
//        $this->unidad_oferta = $unidad_oferta;
    }

    public function crear(UnidadEducativa $unidad_educativa = null, $oferta_educativa = null) {

        return $this->strategy_instance->crear( $unidad_educativa, $oferta_educativa);
    }

//    public function getUnidadEducativa() {
//        
//        return $this->unidad_educativa;
//    }
    /**
     * Elimina 1 unidad_oferta determinada
     * 
     * @return type
     */
    public function eliminar( $unidad_oferta ){
        return $this->strategy_instance->eliminar( $unidad_oferta );
    }
    /**
     * Elimina todas las unidad_oferta de una unidad educativa
     * 
     * @param type $unidad_educativa
     * @return type
     */
    public function eliminarAll( $unidad_educativa ){
        return $this->strategy_instance->eliminarAll( $unidad_educativa );
    }

}