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
     * Por ahora es para actualizar los turnos de las unidades_oferta referidas a carreras
     */
    public function actualizar($entity, $originalTurnos) {

        $em = $this->getEm();

        $respuesta = new Respuesta();

        if ($originalTurnos) {
            // filtro $originalTurnos para que queden los turnos que ya no están presentes en lo que vino del request
            foreach ($entity->getTurnos() as $turno) {
                foreach ($originalTurnos as $key => $toDel) {
                    if ($toDel->getId() === $turno->getId()) {
                        unset($originalTurnos[$key]);
                    }
                }
            }
            //los que quedaron son los que hay que eliminar
            //el turno del array de unidad_educativa ya fue eliminado al bindear con el request

            foreach ($originalTurnos as $unidad_oferta_turno) {
                //elimino la entrada en la tabla unidad_oferta_turno
                $this->getEm()->remove($unidad_oferta_turno);
            }
        }
        try {
            $em->persist($entity);
            $em->flush();
            $respuesta->setClaveNueva($entity->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    /**
     * crea un registro de unidad_oferta
     * tiene funcionamiento diferente al create del Backend.
     * Aquí recibe los parámetros para su creación
     * 
     * @param type $oferta
     * @param type $unidad
     */
    public function crear($unidad_educativa = null, $oferta_educativa = null) {

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
     * Elimina un registro de unidad_oferta para terciario.
     * Al borrar la unidad_oferta hay que eliminar los turnos de unidadoferta_turnos porque 
     * unidad_oferta es el lado inverso de la relacion.
     * 
     * FALTA controlar que se eliminen las cohortes de las carreras
     * 
     */
    public function eliminar($entity, $flush = true) {
        $respuesta = new Respuesta();

        try {
            $this->getEm()->remove($entity);
            
            if ($flush) {
                $this->getEm()->flush();
            };

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
    public function eliminarAll($unidad_educativa) {
        
    }

}
