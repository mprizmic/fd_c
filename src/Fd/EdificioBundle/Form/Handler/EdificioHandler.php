<?php

namespace Fd\EdificioBundle\Form\Handler;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Doctrine\ORM\EntityManager;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EdificioBundle\Event\EdificioNuevoEvent;
use Fd\EdificioBundle\Event\EdificioEvents;
use Fd\EdificioBundle\EventListener\EdificioNuevoSubscriber;
use Fd\EdificioBundle\EventListener\EdificioNuevoListerner;

class EdificioHandler {

    protected $entity_manager;
    protected $class;
    protected $repository;
    protected $respuesta;
    protected $dispatcher;
    protected $listener;

    public function __construct(EntityManager $em, $listener) {
        $this->entity_manager = $em;

        $class = 'Fd\EdificioBundle\Entity\Edificio';
                
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->getName();

        $this->repository = $em->getRepository($class);

        $this->respuesta = new Respuesta();

        $this->dispatcher = new EventDispatcher();

        $this->listener = $listener;
    }

    public function getAllOrdenado() {
        return $this->repository->findAllOrdenado();
    }

    public function create(Edificio $edificio) {

        $this->entity_manager->persist($edificio);
        $this->entity_manager->flush();

        //creo el evento
        //este evento crea un domicilio correspondiente a este edificio
        $event = new EdificioNuevoEvent($edificio);

        //$listener = new EdificioNuevoListener();
        //despacho lo que el subscriber dice
        $this->dispatcher->addListener(EdificioEvents::EDIFICIO_NUEVO, array($this->listener, 'onEdificioNuevo'));

        $this->dispatcher->dispatch(EdificioEvents::EDIFICIO_NUEVO, $event);
    }

    public function update(Edificio $edificio) {
        try {

            $this->entity_manager->persist($edificio);
            $this->entity_manager->flush();
            
            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('Se actualizó exitosamente.');
        } catch (Exception $e) {
            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('No se pudo eliminar. Verifíquelo y reintente.');
        };
        return $this->respuesta;
    }

    /**
     * al dar la baja de un edificio hay que verificar que se den de baja los domicilios correspondientes
     */
    public function delete(Edificio $edificio) {
        try {
            $domicilios = $edificio->getDomicilios();
            //se eliminan todos los domicilios del edificio
            foreach ($domicilios as $domicilio) {
                $edificio->removeDomicilios($domicilio);
                $this->entity_manager->remove($domicilio);
            }
            $this->entity_manager->remove($edificio);
            $this->entity_manager->flush();

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('Se eliminó exitosamente.');
        } catch (Exception $e) {
            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        };
        return $this->respuesta;
    }

}