<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\TablaBundle\Entity\Nivel;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Model\InicialXHandler;
use Fd\OfertaEducativaBundle\Repository\InicialXRepository;

class UnidadOfertaTerciarioHandler {

    private $em;

    public function __construct($em) {
        $this->em = $em;
    }

    private function getEm() {
        return $this->em;
    }

    /**
     * crea un registro de unidad_oferta
     * tiene funcionamiento diferente al create del Backend.
     * Aquí recibe los parámetros para su creación
     * 
     * @param type $oferta
     * @param type $unidad
     */
    public function crear($unidad_educativa = null , $oferta_educativa = null) {
        
        $respuesta = new Respuesta();

        $entity = new UnidadOferta();
        $entity->setOfertas($oferta_educativa);
        $entity->setUnidades($unidad_educativa);

        try {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se generó la oferta educativa para el establecimiento seleccionado.');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo generar la oferta educativa. Verifíquelo y reintente.');
        };
        return $respuesta;
    }
    /**
     * Elimina un registro de unidad_oferta para terciario
     * 
     * FALTA controlar que se eliminen las cohortes de las carreras
     * 
     */
    public function eliminar($entity) {
        $respuesta = new Respuesta();

        try {
            $this->getEm()->remove($entity);
            $this->getEm()->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la oferta educativa para el establecimiento seleccionado.');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo eliminar la oferta educativa. Verifíquelo y reintente.');
        };
        return $respuesta;
    }
    /**
     * Esto debería borrar todas las unidad_oferta de una unidad educativa dada
     * @param type $unidad_educativa
     */
    public function eliminarAll($unidad_educativa){
    }
}
