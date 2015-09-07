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

    /**
     * si se crea un edificio redirecciona a crear un domicilio 
     * 
     * @param Edificio $edificio
     */
    public function create(Edificio $edificio) {
        $this->respuesta = new Respuesta();

        try {
            $this->entity_manager->persist($edificio);
            $this->entity_manager->flush();
            
            // se registra el resultado
            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('Edificio creado correstamente');
            $this->respuesta->setObjNuevo($edificio);
            
        } catch (Exception $ex) {
            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas. No se pudo crear el nuevo edificio');
        }

        /* creo y despacho el evento
         * se despacha el evento que por ahora no hace nada.
         * No servia que creara una domicilio dummy
         */
        $event = new EdificioNuevoEvent($edificio);

        $this->dispatcher->dispatch(EdificioEvents::EDIFICIO_NUEVO, $event);
        
        return $this->respuesta;
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
