<?php

namespace Fd\TablaBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * SexoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NivelRepository extends EntityRepository
{
    /**
     * Esto se usa para armar un array con los valores de niveles que se usa en el DocentesNivelType
     * @return type 
     */
    public function descripciones_niveles(){
        $datos = $this->createQueryBuilder('n')
                ->select('n.nombre, n.abreviatura')
                ->getQuery()
                ->getArrayResult();
        foreach ($datos as $key => $value) {
            $resultado[$value['nombre']] = $value['abreviatura'];
        }
        return $resultado;
    }
}