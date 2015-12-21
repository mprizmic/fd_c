<?php

namespace Fd\EstablecimientoBundle\Model\Strategies;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\TablaBundle\Entity\Dependencia;

class TeSedeStrategy {

    private $em;
    private $ee;

    public function __construct($entity_manager) {
        $this->em = $entity_manager;
    }

    public function getTe($establecimiento_edificio) {
        $ee = $establecimiento_edificio;
        
        $secretaria = $this->em->getRepository('TablaBundle:Dependencia')
                ->findSecretaria();
        
        $oi = $this->em->getRepository('EstablecimientoBundle:OrganizacionInterna')
                ->findOneBy(array(
                    'establecimiento'=>$establecimiento_edificio,
                    'dependencia'=>$secretaria,
                ));
        
        if (!$oi){
            return 'sin Secretaría';
        }
                
        return $oi->getTe();
    }

}
