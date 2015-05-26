<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
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
}
