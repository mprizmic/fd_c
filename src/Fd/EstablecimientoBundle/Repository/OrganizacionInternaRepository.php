<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;

class OrganizacionInternaRepository extends EntityRepository {

    public function qbAll() {
        return $this->createQueryBuilder('oi');
    }

    public function qbAllOrdenado() {
        return $this->qbAll()
                ->join('oi.establecimiento', 'ee')
                ->join('ee.establecimientos', 'e')
                ->join('oi.dependencia', 'd')
                ->orderBy('e.orden', 'ASC')
                ->addOrderBy('d.orden', 'ASC');
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
