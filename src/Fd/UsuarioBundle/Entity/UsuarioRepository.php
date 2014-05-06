<?php

namespace Fd\UsuarioBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {

    public function findTodos() {
        $em = $this->getEntityManager();
        $consulta = $em->createQuery('SELECT ....');
//        $consulta->setParameter('id', $usuario);
        return $consulta->getResult();
    }

    public function findCumpleanios() {
        $qb = $this->createQueryBuilder('u')
                ->select('u.apellido', 'u.nombre', 'u.fecha_nacimiento')
                ->orderBy('u.fecha_nacimiento', 'DESC');
        return $qb->getQuery()->getResult();
    }

}