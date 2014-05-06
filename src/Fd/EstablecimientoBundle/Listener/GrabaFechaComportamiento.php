<?php

namespace Fd\EstablecimientoBundle\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Fd\EdificioBundle\Entity\Edificio;

class GrabaFechaComportamiento {

    public function preUpdate(PreUpdateEventArgs $eventArgs) {


        if ($eventArgs->getEntity() instanceof Edificio) {
          //  $eventArgs->setNewValue('updatedAt', new \DateTime("now"));
            $nuevo = $eventArgs->getNewValue('principal');
            $viejo = $eventArgs->getOldValue('principal');
            $entity = $eventArgs->getEntity();
            $entity->setUpdate();
        }
    }

}