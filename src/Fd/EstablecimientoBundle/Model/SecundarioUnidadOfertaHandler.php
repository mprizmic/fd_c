<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\EstablecimientoBundle\Utilities\TipoUnidadOferta;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Entity\SecundarioX;
use Fd\TablaBundle\Entity\Nivel;

class SecundarioUnidadOfertaHandler extends UnidadOfertaHandler {

    /**
     * Crea un registro de unidad_oferta
     * tiene funcionamiento diferente al create del Backend.
     * Aquí recibe los parámetros para su creación
     * 
     * @param type $oferta
     * @param type $unidad
     */
    public function crear(Localizacion $localizacion, OfertaEducativa $oferta_educativa, $tipo, $flush = false) {

        //se llena el registro de unidad_oferta
        $unidad_oferta = parent::crear($localizacion, $oferta_educativa, TipoUnidadOferta::TUO_SECUNDARIO, true );

        //se crea el registro de secundario_x

        try {

            $entity = new SecundarioX();
            $this->getEm()->persist($entity);
            
            if ($flush) {
                $this->getEm()->flush();
            }

            $unidad_oferta = $respuesta->getObjNuevo();
            $unidad_oferta->setSecundario($entity);
            
            $this->getEm()->persist($unidad_oferta);
            $this->getEm()->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se generó el registro.');
            $respuesta->setClaveNueva($entity->getId());
            $respuesta->setObjNuevo($entity);
            
        } catch (Exception $ex) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo generar el registro. Verifíquelo y reintente.');
        }
        return $respuesta;
    }

    /**
     * Elimina todas las carreras que se estén impartiendo en un edificio de un establecimiento
     * 
     * @param Localizacion $localizacion
     * @param type $flush
     * @return type
     */
    public function eliminarAll(Localizacion $localizacion, $flush = true) {

        //recupero todas las carreras y las especializaciones
        $ofertas = $localizacion->getOfertas();

        try {

            foreach ($ofertas as $key => $value) {
                if ($oferta->getTipo() == TipoUnidadOferta::TUO_SECUNDARIO) {
                    $this->getEm()->remove($entity);
                }
            }
            if ($flush) {
                $this->getEm()->flush();
            };
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la NES para el edificio seleccionado.');
        } catch (Exception $ex) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo eliminar las NES. Verifíquelo y reintente.');
        };
        return $respuesta;
    }

}
