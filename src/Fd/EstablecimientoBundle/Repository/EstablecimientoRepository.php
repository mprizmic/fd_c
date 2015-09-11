<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection as ArrCol;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;

class EstablecimientoRepository extends EntityRepository {

    public function qbAll() {
        return $this->createQueryBuilder('e');
    }

    public function qbAllOrdenado() {
        return $this->qbAll()->orderBy('e.orden', 'ASC');
    }

    public function qyAll() {
        return $this->qbAll()->getQuery();
    }

    public function qyAllOrdenado($campo) {
        return $this->qbAll()->orderBy('e.' . $campo)->getQuery();
    }

    public function findAllOrdenado($campo) {
        return $this->qyAllOrdenado($campo)->getResult();
    }

    /**
     * DEPRECATED para a establecimientoedificiorepository
     * devuelve la query para preguntar por todos los alumnos ordenados alfabeticamente por apellido y nombre
     */
//    public function queryDeUnCui($edificio_id) {
//    }

    /**
     * DEPRECATED pasa a establecimientoedificiorepository
     * devuelve todos los edificios de un establecimiento
     */
//    public function findDeUnCui($edificio_id) {
//    }

    /**
     * devuelve la query de una colecion de objetos de establecimientos que tienen nivel primario
     * 
     * @param type $campo
     * @return type
     * 
     */
    public function qyAllNivelOrdenado($nivel, $campo) {
        $dql = "select e from EstablecimientoBundle:Establecimiento e 
            join e.unidades_educativas ue 
            join ue.nivel n 
            where n.abreviatura= :nivel
            order by e." . $campo;

        $q = $this->_em->createQuery($dql);
        $q->setParameter('nivel', $nivel);
        return $q;
    }

    /**
     * devuelve el edificio principal del establecimiento: cue_anexo='00'
     * 
     * @param \Fd\EstablecimientoBundle\Repository\Establecimiento $establecimiento
     */
    public function findEdificioPrincipal($establecimiento) {
        foreach ($establecimiento->getEdificio() as $establecimiento_edificio) {
            if ($establecimiento_edificio->getCueAnexo() == '00') {
                $edificio = $establecimiento_edificio->getEdificios();
            };
            break;
        };
        return $edificio;
    }

    /**
     * devuelve los edificios de un establecimiento
     * 
     * @return arraycollection de EstablecimientoEdificio
     */
    public function findEdificios($establecimiento) {
        return $this->_em->getRepository('EstablecimientoBundle:EstablecimientoEdificio')->findEdificios($establecimiento);
    }
    /**
     * devuelve los sedes y anexos de un establecimiento
     * 
     * @return arraycollection de EstablecimientoEdificio
     */
    public function findSedeYAnexo($establecimiento) {
        return $this->_em->getRepository('EstablecimientoBundle:EstablecimientoEdificio')->findSedeYAnexo($establecimiento);
    }

    /**
     * DEPRECATED 
     * No existe más findCarrerasPorEstablecimiento en el repository de Carrera
     * 
     */
    
    /**
     * devuelve las carreras de una sede o anexo
     */
    public function findCarreras($establecimiento_edificio) {
        return $this->_em->getRepository('OfertaEducativaBundle:Carrera')->findCarrerasPorSedeAnexo($establecimiento_edificio);
    }

    /**
     * devuelve las especializaciones del establecimiento
     */
    public function findEspecializaciones($establecimiento) {
        return $this->_em->getRepository('OfertaEducativaBundle:Especializacion')->findEspecializacionesPorEstablecimiento($establecimiento);
    }

    /**
     * Dada una carrera devuelve los establecimientos en que se imparte
     * 
     * @param type $campo
     * @return type
     */
    public function findEstablecimientosPorCarrera($carrera) {
        $dql = "select e from EstablecimientoBundle:Establecimiento e 
            join e.unidades_educativas ue 
            join ue.ofertas uo
            join uo.ofertas oe
            join oe.carrera c
            where c.id = :carrera
            order by e.orden";
        $q = $this->_em->createQuery($dql);
        $q->setParameter('carrera', $carrera);
        return $q->getResult();
    }

    /**
     * Dada una especializacion devuelve los establecimientos en que se imparte
     * 
     * @param type $campo
     * @return type
     */
    public function findEstablecimientosPorEspecializacion($especializacion) {
        $dql = "select e from EstablecimientoBundle:Establecimiento e 
            join e.unidades_educativas ue 
            join ue.ofertas uo
            join uo.ofertas oe
            join oe.especializacion esp
            where esp.id = :especializacion
            order by e.orden";
        $q = $this->_em->createQuery($dql);
        $q->setParameter('especializacion', $especializacion);
        return $q->getResult();
    }

    /**
     * FALTA se modifica suponiendo que puede existir unidad_oferta de primario pero no primario_x
     * Devuelve la oferta de primario , si tiene
     * 
     * @param type $establecimiento
     */
    public function findPrimario($establecimiento) {
        $primario_x = new ArrCol();
        $primario = $establecimiento->getUnidadEducativa('Pri');
//        if ($primario) {
//            //deberìa devolver siempre un array de un elemento
//            $ofertas = $primario->existeOferta();
//            if ($ofertas) {
//                $repo = $this->_em
//                        ->getRepository('OfertaEducativaBundle:PrimarioX');
//                $primario_x = $repo->findPrimario( $ofertas[0] );
//            };
//        };
//        return $primario_x;
        return $primario;
    }

    /**
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * devuelve una collection con los apodos de los establecimientos que tienen corhortes cargadas en sus carreras
     */
//    public function findTienenCohortes() {
//        $dql = "
//            select e
//            from EstablecimientoBundle:Establecimiento e 
//            join e.unidades_educativas ue 
//            join ue.ofertas uo 
//            join uo.ofertas oe 
//            join oe.carrera car 
//            join uo.cohortes co 
//            order by e.orden";
//        $q = $this->_em->createQuery($dql);
//        return $q->getResult();
//    }

    /**
     * Lista de establecimientos para un combo
     */
    public function combo() {
        return $this->findAllOrdenado('orden');
    }

    /*
     * FALTA cambia a partir del cambio de localizacion de la oferta
     * 
     * Invoca al UnidadOfertaRepository. Ver ahí todo el detalle
     * 
     * Devuelve un array con los ingresantes, matriculados y egresador de un año en particular de carreras del terciario
     */

//    public function findMatriculaCarrera($anio, $carrera = null, $establecimiento=null){
//        return $this->_em->getRepository('EstablecimientoBundle:UnidadOferta')
//                ->findMatriculaCarrera($anio, $carrera, $establecimiento);
//    }
    /**
     * establecimientos con fecha de creación
     */
    public function findFechasCreacion($tienen_fecha_creacion = true) {
        $qb = $this->createQueryBuilder('e')
                ->select('e.apodo')
                ->addSelect('e.fecha_creacion');

        if ($tienen_fecha_creacion) {
            $qb->where('e.fecha_creacion is not NULL')
                    ->andWhere('LENGTH(e.fecha_creacion) > 0');
        } else {
            $qb->where('e.fecha_creacion is NULL')
                    ->orWhere('LENGTH(e.fecha_creacion) = 0');
        }
        return $qb->getQuery()
                ->getArrayResult();
    }

}
