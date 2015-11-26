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
                ->where('ca.abreviatura = ?1')
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
        $resultado = $this->findear($this->qyAllOrdenado());
        return $resultado;
    }

    public function findear($qb) {
        return $qb->getQuery()->getResult();
    }

}
