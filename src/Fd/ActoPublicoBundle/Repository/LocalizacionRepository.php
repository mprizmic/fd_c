<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EdificioBundle\Repository\DomicilioLocalizacionRepository;

class LocalizacionRepository extends EntityRepository {

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