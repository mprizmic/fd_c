<?php

namespace Fd\OfertaEducativaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;

class CohorteRepository extends EntityRepository {

    /**
     * Devuelve los registro de COHORTE de un determinado establecimiento y una determinada carrera
     * 
     * @param type $establecimiento
     * @param type $carrera
     * @return type $cohorte
     */
    public function findMatricula($establecimiento, $carrera) {
        if ($establecimiento == NULL or $carrera == NULL){
            return NULL;
        };
        
        $oe_id = $carrera->getOferta()->getId();
        $ue_id = $establecimiento->getTerciario()->getId();
        
        $unidad_oferta = $this->_em->getRepository('EstablecimientoBundle:UnidadOferta')->findBy(array('ofertas'=>$oe_id, 'unidades'=>$ue_id));
        
        $xx = $this
                ->createQueryBuilder('c')
                ->where('c.unidad_oferta = :uo')
                ->orderBy('c.anio')
                ->setParameter('uo', $unidad_oferta[0]);
        $yy = $xx->getDQL();
        $entities = $xx->getQuery()
                ->getResult();
        
        return $entities;
    }

}
