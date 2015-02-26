<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection as ArrCol;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;

class EstablecimientoEdificioRepository extends EntityRepository {

    /**
     * devuelve el edificio principal del establecimiento: cue_anexo='00'
     * 
     * @param \Fd\EstablecimientoBundle\Repository\Establecimiento $establecimiento
     */
    public function findEdificioPrincipal($establecimiento) {
        foreach ($establecimiento->getEdificio() as $establecimiento_edificio) {
            if ($establecimiento_edificio->getCueAnexo() == '00') {
                $edificio = $establecimiento_edificio->getEdificios();
            };
            break;
        };
        return $edificio;
    }
    /**
     * devuelve los establecimiento_edificios de un establecimiento ordenados por anexo
     * 
     * @return arraycollection de Edificio
     */
    public function findEdificios($establecimiento){
        return $this->createQueryBuilder('ee')
                ->where('ee.establecimientos = ' . $establecimiento->getId())
                ->orderBy('ee.cue_anexo')
                ->getQuery()
                ->getResult();
    }

}