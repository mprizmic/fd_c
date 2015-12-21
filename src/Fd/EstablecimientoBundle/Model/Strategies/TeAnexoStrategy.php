<?php

namespace Fd\EstablecimientoBundle\Model\Strategies;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\TablaBundle\Entity\Dependencia;

class TeAnexoStrategy {

    private $em;

    public function __construct($entity_manager = null) {
        $this->em = $entity_manager;
    }

    public function getTe($establecimiento_edificio) {
        return $establecimiento_edificio->getTe();
    }

}
