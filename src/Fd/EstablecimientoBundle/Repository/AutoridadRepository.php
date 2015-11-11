<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\TablaBundle\Entity\Cargo;

class AutoridadRepository extends EntityRepository {

    /**
     * DEPRECATED
     * 
     * @return type
     */
    public function findRectores() {

        $q = $this->_em->createQueryBuilder()
                ->select('a')
                ->from('EstablecimientoBundle:Autoridad', 'a')
                ->join('a.cargo', 'ca')
                ->where('ca.abreviatura = ?1' )
                ->orderBy('a.apellido')
                ->addOrderBy('a.nombre');
        
        $q->setParameter(1, "REC");

        return $q->getQuery()->getResult();
    }
    public function qbAll() {
        return $this->createQueryBuilder('e');
    }

    public function qbAllOrdenado() {
        $q = $this->_em->createQueryBuilder()
                ->select('a')
                ->from('EstablecimientoBundle:Autoridad', 'a')
                ->join('a.cargo', 'pe')
                ->join('pe.cargo', 'cg')
                ->join('pe.organizacion', 'oi')
                ->join('oi.establecimiento', 'ee')
                ->join('ee.establecimientos', 'e')
                ->orderBy('a.apellido', 'ASC')
                ->addOrderBy('a.nombre', 'ASC');
        
        return $q;
    }

    public function findAllOrdenado($campo) {
        $resultado = $this->findear( $this->qyAllOrdenado() );
        return $resultado;
    }

    public function findear($qb){
        return $qb->getQuery()->getResult();
    }
    /**
     * dada una carrera devuelve todas sus localizaciones
     */
//    public function findDeCarrera(Carrera $carrera) {
//        $q = $this->_em->createQueryBuilder()
//                ->select('l.id as localizacion_id')
//                ->addSelect('e.id as establecimiento_id')
//                ->addSelect('ee.cue_anexo as cue_anexo')
//                ->addSelect('e.nombre as establecimiento_nombre')
//                ->addSelect('ee.nombre as localizacion_nombre')
//                ->addSelect('uo.id as unidad_oferta_id')
//                ->from('EstablecimientoBundle:Localizacion', 'l')
//                ->join('l.establecimiento_edificio', 'ee')
//                ->join('ee.establecimientos', 'e')
//                ->join('l.ofertas', 'uo')
//                ->join('uo.ofertas', 'oe')
//                ->where('oe.id= ?1')
//                ->orderBy('e.orden')
//                ->addOrderBy('ee.cue_anexo')
//                ->setParameter(1, $carrera->getOferta()->getId());
//
//        $dql = $q->getDQL();
//        $resultado = $q->getQuery()->getResult();
//        return $resultado;
//    }
}
