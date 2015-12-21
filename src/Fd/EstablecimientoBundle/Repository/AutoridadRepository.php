<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\TablaBundle\Entity\Cargo;

class AutoridadRepository extends EntityRepository {

    /**
     * DEPRECATED
     * 
     * @return type
     */
    public function findRectores($establecimiento = null) {

        $q = $this->_em->createQueryBuilder()
                ->select('a.id')
                ->addSelect('a.nombre as nombre')
                ->addSelect('a.apellido as apellido')
                ->addSelect('e.nombre as establecimiento')
                ->addSelect('a.te_particular as te_particular')
                ->addSelect('a.celular as celular')
                ->addSelect('a.email as email')
                ->from('EstablecimientoBundle:Autoridad', 'a')
                ->join('a.cargo', 'pl')
                ->join('pl.cargo', 'cg')
                ->join('pl.organizacion', 'oi')
                ->join('oi.establecimiento', 'ee')
                ->join('ee.establecimientos', 'e')
                ->where('cg.codigo = ?1')
                ->orderBy('a.apellido')
                ->addOrderBy('a.nombre');
        
        $q->setParameter(1, "REC");
        
        if (!is_null($establecimiento)){
            $q->andWhere('e.id = ?2');
            $q->setParameter(2, $establecimiento->getId());
            
            return $rectores = $q->getQuery()->getOneOrNullResult();
            
        }

        return $q->getQuery()->getResult();
    }

    public function qbAll() {
        return $this->createQueryBuilder('e');
    }

    public function qbAllOrdenado() {
        $q = $this->_em->createQueryBuilder()
                ->select('a')
                ->from('EstablecimientoBundle:Autoridad', 'a')
                ->leftJoin('a.cargo', 'pe')
                ->leftJoin('pe.cargo', 'cg')
                ->leftJoin('pe.organizacion', 'oi')
                ->leftJoin('oi.establecimiento', 'ee')
                ->leftJoin('ee.establecimientos', 'e')
                ->orderBy('a.apellido', 'ASC')
                ->addOrderBy('a.nombre', 'ASC');

        return $q;
    }

    public function findAllOrdenado($campo) {
        $resultado = $this->findear($this->qyAllOrdenado());
        return $resultado;
    }

    public function findear($qb) {
        return $qb->getQuery()->getResult();
    }

}
