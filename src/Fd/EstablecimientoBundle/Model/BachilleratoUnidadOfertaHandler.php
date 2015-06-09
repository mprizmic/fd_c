<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\TablaBundle\Entity\Nivel;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;

class BachilleratoUnidadOfertaHandler extends UnidadOfertaHandler {

    const TIPO_UNIDAD_OFERTA = "Bachillerato";
    /**
     * Crea un registro de unidad_oferta
     * tiene funcionamiento diferente al create del Backend.
     * Aquí recibe los parámetros para su creación
     * 
     * @param type $oferta
     * @param type $unidad
     */
    public function crear($localizacion, $oferta_educativa, $tipo) {
        return parent::crear($localizacion, $oferta_educativa, $tipo);
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
                if ($oferta->getTipo() == self::TIPO_UNIDAD_OFERTA) {
                    $this->getEm()->remove($entity);
                }
            }
            if ($flush) {
                $this->getEm()->flush();
            };
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó el bahillerato para el edificio seleccionado.');
        } catch (Exception $ex) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo eliminar. Verifíquelo y reintente.');
        };
        return $respuesta;
    }

}
