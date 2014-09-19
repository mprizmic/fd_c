<?php

namespace Fd\BackendBundle\Form\Handler;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Doctrine\ORM\EntityManager;
use Fd\BackendBundle\Event\UnidadEducativaNuevaEvent;
use Fd\BackendBundle\Event\UnidadEducativaBajaEvent;
use Fd\BackendBundle\Event\BackendEvents;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Repository\InicialXRepository;
use Fd\OfertaEducativaBundle\Entity\Sala;

class UnidadEducativaHandler {

    private $entity_manager;
    protected $class;
    protected $repository;
    protected $respuesta;
    protected $dispatcher;
    protected $listener_crear;
    protected $listener_eliminar;

    public function __construct(EntityManager $em, $listener_crear, $listener_eliminar) {
        $this->entity_manager = $em;
        $class = 'Fd\EstablecimientoBundle\Entity\UnidadEducativa';
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->getName();
        $this->listener_crear = $listener_crear;
        $this->listener_eliminar = $listener_eliminar;
        $this->dispatcher = new EventDispatcher();
        $this->repository = $em->getRepository($class);
        $this->respuesta = new Respuesta();
    }

    /*
     * Se crea una unidad educativa y se despacha un evento. 
     * El evento llama al listener UnidadOfertaUENuevaListener que invvoca al UnidadOfertaHandler.
     * Este es el encargado de crear el registro de UNIDAD_OFERTA.
     * Para ello carga una strategy desde NIVEL que le dice cual es la clase que 'sabe' como crear el 
     * registro de UNIDAD_OFERTA de acuerdo al nivel de la unidad educativa.
     * El UnidadEducativaHandler invoca al método crear() y el strategy crea lo que corresponde.
     * Se usa un UnidadEducativaInicialHandler que invoca al InicialXHandler, SalaHandler y al repositorio de grupo_etario
     * que devuelve un grupo etario dummy para crear una sala, para crear el registro de inicial_x
     * Si bien inicial_x se crea con una sala, luego puede existir sin ninguna sala.
     */
    public function crear(UnidadEducativa $entity) {
        
        try {
            $this->entity_manager->persist($entity);
            $this->entity_manager->flush();

            //creo el evento
            $event = new UnidadEducativaNuevaEvent($entity);

            $this->dispatcher->addListener(BackendEvents::UNIDAD_EDUCATIVA_NUEVA, array($this->listener_crear, 'onUnidadEducativaNueva'));

            $event = $this->dispatcher->dispatch(BackendEvents::UNIDAD_EDUCATIVA_NUEVA, $event);
            
        } catch (Exception $e) {
            
            return new Respuesta(2, 'Problemas en la creación de la unidad educativa');
        };

        return $event->getRespuesta();
    }

    /**
     * Al dar la baja una unidad educativa hay que verificar que se den de baja UNIDAD_OFERTA, 
     * TURNOS, COHORTES, y todo lo que corresponda 
     * según el nivel
     */
    public function eliminar(UnidadEducativa $entity) {
        try {
            
            //creo el evento
            $event = new UnidadEducativaBajaEvent($entity);

            $this->dispatcher->addListener(BackendEvents::UNIDAD_EDUCATIVA_BAJA, array($this->listener_eliminar, 'onUnidadEducativaBaja'));

            $event = $this->dispatcher->dispatch(BackendEvents::UNIDAD_EDUCATIVA_BAJA, $event);
            /*
             * el event trae la respuesta del proceso de los listeners. Se puede hacer algo con esto.
             */
            
            //finalmente se elimina el registro de unidad_educativa
            $this->entity_manager->remove($entity);
            $this->entity_manager->flush();

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('Se eliminó la unidad educativa exitosamente.');
            
        } catch (Exception $e) {

            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        };

        return $this->respuesta;
    }
    /**
     * Actualiza un registro de la tabla.
     * Para el caso en que se esté eliminando directamente la unidad educativa
     * FALTA ver que pasa con el resto de las relaciones: unidad_oferta, cohortes, etc
     * 
     * @param type $entity
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($entity, $flush = null) {
        $respuesta = new Respuesta();

        try {
            $this->entity_manager->persist($entity);
            
            if ($flush){
                $this->entity_manager->flush();
                $respuesta->setClaveNueva($entity->getId());
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la unidad educativa exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la unidad educativa. Verifique los datos y reintente');
        }

        return $respuesta;
    }

}