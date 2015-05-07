<?php

namespace Fd\EdificioBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EdificioBundle\lib\Respuesta;

class EdificioRepository extends EntityRepository {

    /**
     * para el paginador ideup no funciona el findAll por que necesita que se le pase un query y no un result
     */
    public function qyAll(){
        return $this->createQueryBuilder('e')->getQuery();
    }
    /**
     * devuelve la query para preguntar por 
     */
    public function queryDeUnCue($establecimiento_id) {
        $dql = 'select ed from EdificioBundle:Edificio ed join ed.establecimiento edes 
            join ed.comuna cm join ed.cgp cgp join ed.barrio br
            join ed.distritoEscolar de
            where edes.establecimientos = :establecimiento_id';
        $q = $this->_em->createQuery($dql);
        $q->setParameter('establecimiento_id', $establecimiento_id);
        return $q;
    }

    /**
     * devuelve todos los edificios de un establecimiento
     */
    public function findDeUnCue($establecimiento_id) {
        return $this->queryDeUnCue($establecimiento_id)->getResult();
    }

    public function findDomicilioPrincipal($id) {
        $dql = 'select e from EdificioBundle:Edificio e
            where e.id = :id
            and e.principal=true';
        $q = $this->_em->createQuery($dql);
        $q->setParameter('id', $id);
        return $q->getSingleResult();
    }
    public function qbAllOrdenado(){
        return $this->createQueryBuilder('e')
                ->join('e.domicilios', 'd')
                ->where('d.principal=true')
                ->orderBy('d.calle');
        
    }
    public function qyAllOrdenado(){
        return $this->qbAllOrdenado()->getQuery();
    }
    public function findAllOrdenado(){
        return $this->qbAllOrdenado()
                ->getQuery()
                ->getResult();
    }
    /**
     * devuelve todos los domicilios de un edificio en particular
     */
    public function findDomicilios( $edificio ){
        $repositorio = $this->getEntityManager()->getRepository('EdificioBundle:Domicilio');
        $domicilios = $repositorio->getFilterBy(array('edificio' => $edificio->getId() ))->getQuery()->getResult();
        return $domicilios;
    }
}
