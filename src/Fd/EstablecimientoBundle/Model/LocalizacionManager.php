<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EdificioBundle\Model\DomicilioLocalizacionManager;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Model\NivelManager;

class LocalizacionManager  {

    protected $em;
    protected $respuesta;
    protected $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
        $this->repository = $em->getRepository('EstablecimientoBundle:Localizacion');
    }

    /**
     * crear una carrera implica crear el regitro de ofertaeducativa correspondiente
     * 
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $entity
     * @return type
     */
//    public function crear(Carrera $entity, $flush = true) {
//
//        try {
//            //busco entidad NIVEL
//            //devuelve un array de una posicion
//            $nivel_manager = new NivelManager($this->getEm());
//            $nivel = $nivel_manager->crearLleno('Ter');
//
//            //se genera la oferta educativa
//            $oe_manager = new OfertaEducativaManager($this->getEm());
//            $oferta = $oe_manager->crearLlena($nivel);
//
//            //se genera la carrera
//            $entity->setOferta($oferta);
//            $this->em->persist($entity);
//            if ($flush) {
//                $this->em->flush();
//            };
//
//            $this->respuesta->setCodigo(1);
//            $this->respuesta->setMensaje('La carrera se creó correctamente');
//            $this->respuesta->setClaveNueva($entity->getId());
//        } catch (Exception $e) {
//
//            $this->respuesta->setCodigo(2);
//            $this->respuesta->setMensaje('Problemas en la creación de la carrera');
//
//            return $this->respuesta;
//        };
//
//        return $this->respuesta;
//    }

    /**
     * Crea un nuevo objeto vacío
     * 
     * @return Carrera
     */
//    public function crearNuevo() {
//        return new Carrera();
//    }

    /**
     * Actualiza un registro de la tabla.
     * 
     * @param type $entity
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($entity, $flush = null) {
        $respuesta = new Respuesta();

        try {
            $this->em->persist($entity);
            
            if ($flush){
                $this->em->flush();
                $respuesta->setClaveNueva($entity->getId());
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó  exitosamente la información de la localización de la unidad educativa dle establecimiento');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar. Verifique los datos y reintente');
        }

        return $respuesta;
    }
    /**
     * Se elimina una localizacion que está vacía, no tiene ninguna unidad oferta asociada
     * 
     * FALTA tiene que eliminar todo lo que la localizacion tiene asociado? se supone que no 
     * 
     */
    public function eliminar(Localizacion $localizacion, $flush = true) {
        
        try {

            //elimino la carrera
            $this->em->remove($localizacion);

            if ($flush) {
                $this->em->flush();
            };

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('Se eliminó la relación de la unidad educativa y el edificio en que se imparte exitosamente.');
        } catch (Exception $e) {

            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $this->respuesta;
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
        $repo_dl = $this->em->getRepository('EdificioBundle:DomicilioLocalizacion');
        
        $domicilio_localizacion_manager = new DomicilioLocalizacionManager($this->em);

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
                        $domicilio_bd = $this->em->getRepository('EdificioBundle:Domicilio')
                                ->find($domicilio['domicilio_id']);

                        $respuesta = $domicilio_localizacion_manager->crear($entity, $domicilio_bd);
                        //ante la primera falla en la grabación se corta el proceso
                        if ($respuesta->getCodigo() != 1) {
                            //se corta el proceso porque hubo un error al grabar algún dato
                            break;
                        };
                    }
                } else {
                    if ($domicilio_localizacion) {
                        $domicilio_bd = $this->em->getRepository('EdificioBundle:Domicilio')
                                ->find($domicilio['domicilio_id']);

                        $respuesta = $domicilio_localizacion_manager->eliminar($domicilio_localizacion);
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
    
}
