<?php

namespace Fd\TablaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;

class DependenciaRepository extends EntityRepository {

    public function getBuilder() {
        return $this->createQueryBuilder('d');
    }

    public function filterBy(&$builder, $campo) {
        $clave = key($campo);
        $builder->where('d.' . $clave . '= :' . $clave);
        $builder->setParameter($clave, $campo[$clave]);
        return $builder;
    }

    /**
     * devuelve el builder de la consulta de los domicilios filtrados por el valor de algún campo.
     * Ejemplo de uso
     * $domicilios = $repositorio->getFilterBy(array('edificio' => 22))->getQuery()->getResult();
     * 
     * @param type $campo
     * @return type
     */
    public function getFilterBy($campo) {
        $builder = $this->getBuilder();

        $this->filterBy($builder, $campo);
        return $builder;
    }
}
