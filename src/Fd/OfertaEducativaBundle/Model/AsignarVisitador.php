<?php

/**
 * Esta clase responde a un pattern visitor
 * Visita al manager de carrera para asignar una carrera a un establecimiento
 * Lo mismo para Especializacion
 * 
 */

namespace Fd\OfertaEducativaBundle\Model;

use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadoInterface;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadorInterface;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\EstablecimientoBundle\Model\CarreraUnidadOfertaHandler;

class AsignarVisitador implements AsignarVisitadorInterface {

    /**
     * Podría tener cualquier estructura
     */
    protected $data;

    /**
     * El visitado puede o no pasarle datos necesarios para la asignacion
     * @param type $data
     */
    public function __construct($data = null) {
        $this->data = $data;
    }

    /**
     * Visita a la carrera y la asigna al establecimeinto
     * Los datos sales de $this->data porque se los paso el visitado
     * 
     * @param AsignarVisitadoInterface $visitado
     * @return type
     */
    public function visitCarrera(AsignarVisitadoInterface $visitado) {
        /**
         * Para cada establecimiento localizado, si esta seleccionado se debe crear el registro de la tabla unidad_oferta (en caso de no preexistir).
         * Si no está seleccionado, se debe borrar el registro de dicha tabla (en caso de preexistir)
         */
        
        //se setea la respuesta negativa
        $respuesta = new Respuesta(2, 'Problemas en la asignación');

        //se verifica si ya existe la unidad_oferta, si se imparte o no la carrera en la localizacion
        $localizacion = $this->data['localizacion'];
        $carrera = $this->data['carrera'];
        $unidad_oferta = $visitado->getEm()->getRepository('EstablecimientoBundle:Localizacion')
                ->findSeImparte( $localizacion, $carrera, false);

        //se crea el manejador de unidad_oferta
        $handler = new CarreraUnidadOfertaHandler($visitado->getEm());
        
        //accion asignar carrera
        if (!$unidad_oferta) {
            if ($this->data['accion'] == 'Asignar') {
                
                //no existe la asignacion y hay que crearla
                $respuesta = $handler->crear($localizacion, $carrera->getOferta(), 'Carrera');
            }
        };

        //accion desasignar carrera
        if ($unidad_oferta) {
            if ($this->data['accion'] == 'Desasignar') {

                //existe y hay que darlo de baja
                //
                //creo el handler para la unidad_oferta
                $respuesta = $handler->eliminar($unidad_oferta);
            }
        };

        return $respuesta;
    }

    public function visitEspecializacion(AsignarVisitadoInterface $visitado) {
        //aca va como se asigna
    }

}
