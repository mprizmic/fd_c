<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Nivel;

class UnidadEducativaRepository extends EntityRepository {

    /**
     * Actualiza un registro de la tabla.
     * Para el caso en que se esté eliminando directamente la unidad educativa, los turnos se borran en cascada. 
     * FALTA ver que pasa con el resto de las relaciones: unidad_oferta, cohortes, etc
     * 
     * Para el caso en que se esté eliminando algún turno, hay que revisar a mano la relación con la tabla TurnoUnidadEducativa
     * 
     * @param type $entity
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($entity, $originalTurnos = null) {
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

            foreach ($originalTurnos as $turno_unidad_educativa) {
                //elimino la entrada en la tabla turno_unidad_educativa
                $this->_em->remove($turno_unidad_educativa);
            }
        }

        try {
            $this->_em->persist($entity);
            $this->_em->flush();
            $respuesta->setClaveNueva($entity->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la unidad educativa exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la unidad educativa. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    /**
     * devuelve la query para preguntar por todos los niveles de un establecimiento
     */
    public function queryDeUnCue($establecimiento_id) {
        $dql = 'select ue from EstablecimientoBundle:UnidadEducativa ue join ue.nivel n
            where ue.establecimiento = :establecimiento_id
            order by n.orden';
        $q = $this->_em->createQuery($dql);
        $q->setParameter('establecimiento_id', $establecimiento_id);
        return $q;
    }

    /**
     * devuelve todos los edificios de un establecimiento
     */
    public function findDeUnCue($establecimiento_id) {
        return $this->queryDeUnCue($establecimiento_id)->getResult();
    }

    /**
     * devuelve un querybuilder que devolverá registros de unidad educativa de 
     * los terciarios de los establecimientos ordenados por el campo orden de los establecimientos
     */
    public function qbLosTerciariosOrdenados() {
        $qb = $this->createQueryBuilder('ue')
                ->join('ue.nivel', 'n')
                ->join('ue.establecimiento', 'e')
                ->where('n.abreviatura = :nivel')
                ->orderBy('e.orden')
                ->setParameter('nivel', 'Ter');
        return $qb;
    }

}