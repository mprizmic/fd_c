<?php

namespace Fd\TablaBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TipoNormaRepository extends EntityRepository {

    public function qbTodos() {
        return $this->createQueryBuilder('t');
    }
    public function qbTodosOrdenado(){
        return $this->qbTodos()->orderBy('t.codigo');
    }
    public function qyTodosOrdenado(){
        return $this->qbTodosOrdenado()->getQuery();
    }
    public function findAllOrdenado(){
        return $this->createQueryBuilder('t')->orderBy('t.codigo')->getQuery()->getResult();
    }

}