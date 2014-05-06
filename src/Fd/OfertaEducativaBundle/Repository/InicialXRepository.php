<?php

namespace Fd\OfertaEducativaBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;

class InicialXRepository extends EntityRepository {
    
    /**
     * Devuelve un objeto inicial_x que tiene las salas de una unidad_oferta determinada
     * Para el caso de Inicial, el registro de inicial_x es único.
     * Puede devolver un objeto inicial_x (o nulo)que se supone que existe siempre) o null
     * Si inicial_x no tiene salas devuelve el registro de inicial_x sin salas.
     * 
     * @param type $unidad_oferta
     * @return type
     */
    public function findSalas(UnidadOferta $unidad_oferta){
        $dql = "select i from OfertaEducativaBundle:InicialX i 
            left join i.salas s 
            left join s.grupo_etario ge
            where i.unidad_oferta = :unidad_oferta
            order by ge.orden";

        $q = $this->_em->createQuery($dql);
        $q->setParameter('unidad_oferta', $unidad_oferta);
        $inicial_x = $q->getResult();
        
        if ($inicial_x){
            return $inicial_x[0];
        }else{
            return null;
        };
    }
    
}
?>
