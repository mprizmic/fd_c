<?php

namespace Fd\EdificioBundle\Repository;

use Doctrine\ORM\EntityRepository;

class InspectorRepository extends EntityRepository {

    public function qyAll() {
        return $this->createQueryBuilder('e')->getQuery();
    }

    public function qyAllOrdenado() {
        return $this->qbAllOrdenado()->getQuery();
    }

    public function findAllOrdenado() {
        return $this->qbAllOrdenado()
                        ->getQuery()
                        ->getResult();
    }

}
