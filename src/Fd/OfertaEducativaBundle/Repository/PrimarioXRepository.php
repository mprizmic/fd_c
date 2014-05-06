<?php

namespace Fd\OfertaEducativaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;

class PrimarioXRepository extends EntityRepository {

    /**
     * Devuelve un objeto primario_x que los datos de un primario determinado en un establecimiento
     * Para el caso de Primario, el registro de primario_x es único.
     * Puede devolver un objeto primario_x (que se supone que existe siempre) o null
     * 
     * @param type $unidad_oferta
     * @return type
     */
    public function findPrimario(UnidadOferta $unidad_oferta) {

        $q = $this->createQueryBuilder('p')
                ->where('p.unidad_oferta = :unidad_oferta');

        $q->setParameter('unidad_oferta', $unidad_oferta);

        $primario_x = $q->getQuery()
                ->getSingleResult();

        return ($primario_x) ? $primario_x : null;
    }

}

?>
