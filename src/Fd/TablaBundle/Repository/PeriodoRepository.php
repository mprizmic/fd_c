<?php

namespace Fd\TablaBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PeriodoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PeriodoRepository extends EntityRepository {

    /**
     * devuelve un querybuilder
     */
    public function qbPorOrden() {
        $qb = $this->_em->createQueryBuilder()
                ->select(array('p'))
                ->from('TablaBundle:Periodo', 'p')
                ->join('p.tipo_periodo', 't')
                ->orderBy('p.fecha_inicio')
                ->addOrderBy('t.codigo', 'asc');
        return $qb;
    }

    /*
     * devuelve el query
     */

    public function queryPorOrden() {
        return $this->qbPorOrden()->getQuery();
    }

    /*
     * devuelve el resultado de la consulta
     */

    public function findPorOrden() {
        return $this->queryPorOrden()->getResult();
    }

    /*
     * recupera el periodo correspondiente al día de hoy tomando periodo cuatrimestral
     */
    public function findHoy() {
        $hoy = date('Y-m-d');

        $periodo_hoy = $this->_em->createQueryBuilder()
                ->select('p')
                ->from('TablaBundle:Periodo', 'p')
                ->join('p.tipo_periodo', 't')
                ->where('p.fecha_fin>=:hoy1')
                ->andWhere('p.fecha_inicio<=:hoy2')
                ->orderBy('p.fecha_inicio')
                ->orderBy('t.codigo','desc')
                ->getQuery();
        $periodo_hoy->setParameter('hoy1', $hoy);
        $periodo_hoy->setParameter('hoy2', $hoy);
        $periodo_hoy->setMaxResults(1);

        return $periodo_hoy->getSingleResult();
    }
    /**
     * a partir de un periodo calcula y devuelve el periodo siguiente
     * si no se pasa parametro se asume la fecha del dia y luego se calcula el periodo siguiente
     * 
     * @param type $periodo
     * @return type 
     */
    public function findSiguiente($periodo = null)
    {
        if ($periodo==null){
            $hoy = date('Y-m-d');
        }else{
            $hoy = $periodo->getFechaFin();
        }

        $dql = 'select p from TablaBundle:Periodo p  
            where p.fecha_inicio>:hoy1
            order by p.fecha_inicio, p.fecha_fin';
        $q = $this->_em->createQuery($dql);
        $q->setParameter('hoy1', $periodo==null ? date('Y-m-d') : $periodo->getFechaFin());
        $q->setMaxResults(1);
        
        return $q->getSingleResult();        
    }
}