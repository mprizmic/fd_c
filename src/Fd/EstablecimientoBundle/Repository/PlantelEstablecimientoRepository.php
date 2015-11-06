<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;

class PlantelEstablecimientoRepository extends EntityRepository {

    public function qbAll() {
        return $this->createQueryBuilder('pe');
    }

    public function qbAllOrdenado() {
        return $this->qbAll()
                ->join('pe.dependencias', 'oi')
                ->join('oi.establecimiento', 'ee')
                ->join('ee.establecimientos', 'e')
                ->join('oi.dependencia', 'd')
                ->join('pe.cargo', 'cg')
                ->orderBy('e.orden', 'ASC')
                ->addOrderBy('d.orden', 'ASC')
                ->addOrderBy('cg.orden', 'ASC');
    }

    public function qyAll() {
        return $this->qbAll()->getQuery();
    }

    public function qyAllOrdenado() {
        return $this->qbAllOrdenado()->getQuery();
    }

    public function findAllOrdenado() {
        return $this->qyAllOrdenado()->getResult();
    }

}
