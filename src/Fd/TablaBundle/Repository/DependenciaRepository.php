<?php

namespace Fd\TablaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitadorInterface;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitadoInterface;

class DependenciaRepository extends EntityRepository implements DatosAChoiceVisitadoInterface {

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

    public function qbAllOrdenado() {
        $qb = $this->getBuilder()
                ->orderBy('d.orden', 'ASC');
        return $qb;
    }

    public function findAllOrdenado() {

        return $this->findear(
                        $this->qbAllOrdenado()
        );
    }

    /**
     * dado un querybuilder devuelve los resultados de la consulta
     */
    public function findear($qb) {
        return $qb->getQuery()->getResult();
    }

    /**
     * Es visitado para pasar los datos de una Collection a un array determinado
     * el findDependenciasOrdenados pasa a un array con un cierto formato
     * 
     * @param DatosAChoiceVisitadorInterface $visitador
     * @return type
     */
    public function acceptDatosAChoice(DatosAChoiceVisitadorInterface $visitador) {
        return $visitador->visitDependencia($this);
        ;
    }

}
