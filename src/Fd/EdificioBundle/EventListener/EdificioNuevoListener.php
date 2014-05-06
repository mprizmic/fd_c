<?php

namespace Fd\EdificioBundle\EventListener;

use Fd\EdificioBundle\Event\EdificioNuevoEvent;
use Fd\EdificioBundle\Event\EdificioEvents;
//use Doctrine\ORM\EntityManager;
use Fd\EdificioBundle\Model\DomicilioTemporario;

class EdificioNuevoListener {

    private $em;
    private $domicilio_temporario;

    public function __construct($domicilio_temporario) {
//        $this->em = $entity_manager;
        $this->domicilio_temporario = $domicilio_temporario;
    }

    /**
     * cuando se crea un edificio automáticamente se le crea un domicilio
     */
    public function onEdificioNuevo(EdificioNuevoEvent $event) {
        //se crea el domicilio temporario con este servicio
        $this->domicilio_temporario->crearTemporario($event->getEdificio());
        return;
    }

}
