<?php

namespace Fd\OfertaEducativaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez;

/**
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TituloEstadoValidezRepository extends EntityRepository {

    /**
     * devuelve la lista de objetos titulo_estado_validez corespondientes a un titulo
     * 
     */
    public function findHistoriaEstadoValidez($titulo) {
        return $this->createQueryBuilder('tev')
                        ->where('tev.carrera = :clave')
                        ->setParameter('clave', $titulo->getId())
                        ->orderBy('cev.createdAt')
                        ->getQuery()
                        ->getResult();
    }

}