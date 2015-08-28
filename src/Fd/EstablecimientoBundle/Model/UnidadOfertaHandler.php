<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Model\InicialUnidadOfertaHandler;
use Fd\EstablecimientoBundle\Model\CarreraUnidadOfertaHandler;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Model\NivelManager;

/**
 * Handler genérico para los unidad_oferta
 * De este handler heredan los handler de cada tipo de unidad_oferta
 * 
 */
class UnidadOfertaHandler {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    protected function getEm() {
        return $this->em;
    }

    /**
     * Por ahora es para actualizar los turnos de todos los tipos de unidad oferta
     * @param UnidadOferta $entity un objeto de la clase UnidadOFerta
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
    public function crear(Localizacion $localizacion, OfertaEducativa $oferta_educativa, $tipo, $flush = false) {

        $respuesta = new Respuesta();

        $entity = new UnidadOferta();
        
        $entity->setOfertas($oferta_educativa);
        $entity->setLocalizacion($localizacion);
        $entity->setTipo($tipo);

        try {
            $this->getEm()->persist($entity);

            if ($flush) {
                $this->getEm()->flush();
            }

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se generó la oferta educativa para la sede/anexo del establecimiento seleccionado.');
            $respuesta->setClaveNueva($entity->getId());
            $respuesta->setObjNuevo($entity);
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo generar la oferta educativa. Verifíquelo y reintente.');
        };
        return $respuesta;
    }

    /**
     * Elimina 1 unidad_oferta determinada
     * 
     * Al borrar la unidad_oferta hay que eliminar los turnos de unidadoferta_turnos porque 
     * unidad_oferta es el lado inverso de la relacion.
     * 
     * FALTA controlar que se eliminen las cohortes de las carreras, y lo de los otros tipos
     * 
     * @return type
     */
    public function eliminar($unidad_oferta, $flush = true) {
//        return $this->strategy_instance->eliminar( $unidad_oferta, $flush );
        $respuesta = new Respuesta();

        try {
            $this->getEm()->remove($unidad_oferta);

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
     * Elimina todas las unidad_oferta de una localizacion
     * 
     * @param type $unidad_educativa
     * @return type
     */
    public function eliminarAll(Localizacion $localizacion, $flush = true) {
        
        //recupero todas las carreras y las especializaciones
        $ofertas = $localizacion->getOfertas();

        try {

            foreach ($ofertas as $key => $value) {
                $respuesta = $this->eliminar($value, false);
                
                if ($respuesta->getCodigo() <> 1 ){ return $respuesta;}
            }

            if ($flush) {
                $this->getEm()->flush();
            };
            
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminaron las ofertas para el edificio seleccionado.');
            
        } catch (Exception $ex) {
            
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudieron eliminar las ofertas. Verifíquelo y reintente.');
        };
        
        return $respuesta;
    }

}
