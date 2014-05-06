<?php

namespace Fd\OfertaEducativaBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\Event;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\CarreraEstadoValidez;

class CarreraListener {

    private $anterior;

    private function getAnterior() {
        return $this->anterior;
    }

    private function setAnterior(PreUpdateEventArgs $eventArgs = null, $carrera = null) {
        if (is_null($carrera)) {
            $this->anterior = null;
            return;
        };
        $this->anterior = $carrera;
        $this->anterior = $carrera->setEstadoValidez($eventArgs->getOldValue('estado_validez'));
        $this->anterior = $carrera->setFechaEstadoValidez($eventArgs->getOldValue('fecha_estado_validez'));
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs) {
        $carrera = $eventArgs->getEntity();
        if ($eventArgs->hasChangedField('estado_validez')) {
            $this->setAnterior($eventArgs, $carrera);
        };
    }

    public function postFlush(PostFlushEventArgs $eventArgs) {
        if (sizeof($this->getAnterior()) > 0) {
            $em = $eventArgs->getEntityManager();
//            foreach ($em->getUnitOfWork()->getScheduledEntityUpdates() as $entity) {
//                if ($entity instanceof Carrera) {
//                    $cev = new CarreraEstadoValidez();
//                    $em->persist($cev);
//                };
//            };
            
//            $cev = $em->getRepository('OfertaEducativaBundle:CarreraEstadoValidez')->generar($this->getAnterior());
            $cev = new CarreraEstadoValidez( $this->getAnterior() );
            $em->persist($cev);
            //hace que no se vuelva a grabar el registro anterior
            $this->setAnterior();
            $em->flush($cev);
        };
    }

}