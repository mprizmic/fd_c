<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EdificioBundle\Repository\DomicilioLocalizacionRepository;
use Fd\OfertaEducativaBundle\Entity\Carrera;

class LocalizacionRepository extends EntityRepository {

    /**
     * verifica si una carrera se imparte en una sede/anexo de un establecimiento
     */
    public function findSeImparte(Localizacion $localizacion, Carrera $carrera) {
        $unidad_oferta = $this->_em->getRepository('EstablecimientoBundle:UnidadOferta')->findBy(
                array(
                    'localizacion' => $localizacion,
                    'ofertas' => $carrera->getOferta(),
                )
        );
        if (!$unidad_oferta){
            return false;
        };
        return true;
    }

    /**
     * devuelve un array de localizaciones de las sedes y anexos en los que se imparten terciarios
     * ordenados por establecimiento y cue_anexo
     * 
     * resultado[][establecimiento_nombre]
     * resultado[][localizacion_id]
     * resultado[][establecimiento_edificio_nombre]
     */
    public function findTerciarios() {
        $qb = $this->_em->createQueryBuilder()
                ->select('l as localizacion')
                ->addSelect('e.apodo as establecimiento_nombre')
                ->addSelect('l.id as localizacion_id')
                ->addSelect('ee.nombre as establecimiento_edificio_nombre')
                ->from('EstablecimientoBundle:Localizacion', 'l')
                ->innerJoin('l.establecimiento_edificio', 'ee')
                ->innerJoin('ee.establecimientos', 'e')
                ->innerJoin('l.unidad_educativa', 'ue')
                ->innerJoin('ue.nivel', 'n')
                ->where('n.abreviatura = ?1')
                ->orderBy('e.orden')
                ->addOrderBy('ee.cue_anexo');

        $qb->setParameter(1, 'Ter');
        $x = $qb->getDQL();
        $resultado = $qb->getQuery()
                        ->getResult();
        return $resultado;
    }

    /**
     * 
     * dada una localizacion devuelve todos los turnos que tienen todas las ofertas que en dicha unidad educativa se imparta en esa sede
     */
    public function findTurnos(\Fd\EstablecimientoBundle\Entity\Localizacion $localizacion) {

        $todos = array();

        foreach ($localizacion->getOfertas() as $key => $unidad_oferta) {

            $parcial = array();

            foreach ($unidad_oferta->getTurnos() as $key2 => $un_turno) {
                $parcial[] = $un_turno->getTurno()->getDescripcion();
            }

            $todos = array_merge($todos, $parcial);
        };

        return array_unique($todos);
    }

    /**
     * Asigna domicilios a una localizacion creando los registros de la tabla domicilio_localizacion
     * 
     * @param $entity es la localizacion
     * @param $data son los datos tal cual vienen en la matriz que se edita en el formulario de la página
     */
    public function asignar_domicilios($entity, $data) {
        /**
         * estructura de data:
         * flag: si se marcó o no
         * nombre
         * domicilio_id
         * domicilio_localizacion_id
         * principal
         * 
         */
        $respuesta = new Respuesta();

        //repositorio de la tabla que se actualiza
        $em = $this->getEntityManager();
        $repo_dl = $em->getRepository('EdificioBundle:DomicilioLocalizacion');

        /**
         * Si es principal no se toca.
         * Si no es principal
         *      Si el flag esta marcado
         *          se verifica si existe domicilio_localizacion. Se crea si no existe.
         *      Si el flag no está marcado
         *          e verifica si existe domcilio_localizacion. Se borra si existe.
         */
        $domicilios = $data['domicilios'];
        foreach ($domicilios as $key => $domicilio) {

//            $repo_dl = $em->getRepository('EdificioBundle:DomicilioLocalizacion');

            if ($domicilio['principal']) {
                //no se toca
            } else {
                $domicilio_localizacion = $repo_dl->find($domicilio['domicilio_localizacion_id']);

                //si el domicilio fue seleccionado, en caso que no exista se crea.
                if ($domicilio['flag']) {

                    if (!$domicilio_localizacion) {
                        //no existe y se crea
                        $domicilio_bd = $em->getRepository('EdificioBundle:Domicilio')
                                ->find($domicilio['domicilio_id']);

                        $respuesta = $repo_dl->crear($entity, $domicilio_bd);
                        //ante la primera falla en la grabación se corta el proceso
                        if ($respuesta->getCodigo() != 1) {
                            //se corta el proceso porque hubo un error al grabar algún dato
                            break;
                        };
                    }
                } else {
                    if ($domicilio_localizacion) {
                        $domicilio_bd = $em->getRepository('EdificioBundle:Domicilio')
                                ->find($domicilio['domicilio_id']);

                        $respuesta = $repo_dl->eliminar($domicilio_localizacion);
                        //ante la primera falla en la grabación se corta el proceso
                        if ($respuesta->getCodigo() != 1) {
                            //se corta el proceso porque hubo un error al grabar algún dato
                            break;
                        };
                    }
                }
            }
        }

        //si la última grabación sucedió ok todo se grabó ok. Se manda mensaje
        if ($respuesta->setCodigo(1)) {
            $respuesta->getMensaje('Se asignaron exitosamente los domicilios.');
        };

        return $respuesta;
    }

    /**
     * dada una carrera devuelve todas sus localizaciones
     */
    public function findDeCarrera(Carrera $carrera) {
        $q = $this->_em->createQueryBuilder()
                ->select('l.id as localizacion_id')
                ->addSelect('e.id as establecimiento_id')
                ->addSelect('ee.cue_anexo as cue_anexo')
                ->addSelect('e.nombre as establecimiento_nombre')
                ->addSelect('ee.nombre as localizacion_nombre')
                ->addSelect('uo.id as unidad_oferta_id')
                ->from('EstablecimientoBundle:Localizacion', 'l')
                ->join('l.establecimiento_edificio', 'ee')
                ->join('ee.establecimientos', 'e')
                ->join('l.ofertas', 'uo')
                ->join('uo.ofertas', 'oe')
                ->where('oe.id= ?1')
                ->orderBy('e.orden')
                ->addOrderBy('ee.cue_anexo')
                ->setParameter(1, $carrera->getOferta()->getId());

        $dql = $q->getDQL();
        $resultado = $q->getQuery()->getResult();
        return $resultado;
    }

    /**
     * dado un establecimiento devuelve todas sus localizaciones
     * 
     * @param type $establecimiento_id
     * @return type
     */
    public function findDelEstablecimiento($establecimiento_id) {

        $dql = "
            select l from EstablecimientoBundle:Localizacion l 
            join l.unidad_educativa ue 
            where ue.establecimiento=:establecimiento";
        $q = $this->_em->createQuery($dql);
        $q->setParameter('establecimiento', $establecimiento_id);
        return $q->getResult();
    }

    /**
     * elimina un registro 
     */
    public function eliminar($id) {
        $respuesta = new Respuesta();

        $entity = $this->find($id);

        if (!$entity) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se encontró el código que se desea eliminar');
        } else {
            try {
                $em = $this->getEntityManager();
                $em->remove($entity);
                $em->flush();

                $respuesta->setCodigo(1);
                $respuesta->setMensaje('Se eliminó la relación de la unidad educativa y el edificio en que se imparte.');
            } catch (Exception $e) {
                $respuesta->setCodigo(3);
                $respuesta->setMensaje('No se pudo eliminar la relación de la unidad educativa y el edificio en que se imparte. Verifíquelo y reintente.');
            };
        }
        return $respuesta;
    }

}
