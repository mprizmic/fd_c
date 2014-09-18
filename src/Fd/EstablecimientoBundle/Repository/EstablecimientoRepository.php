<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection as ArrCol;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;

class EstablecimientoRepository extends EntityRepository {

    public function qbAll() {
        return $this->createQueryBuilder('e');
    }
    public function qbAllOrdenado(){
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
     * devuelve la query para preguntar por todos los alumnos ordenados alfabeticamente por apellido y nombre
     */
    public function queryDeUnCui($edificio_id) {
        $dql = 'select es 
            from EstablecimientoBundle:Establecimiento es
            join es.edificio esed
            where esed.edificios = :edificio_id';

        $q = $this->_em->createQuery($dql);
        $q->setParameter('edificio_id', $edificio_id);
        return $q;
    }

    /**
     * devuelve todos los edificios de un establecimiento
     */
    public function findDeUnCui($edificio_id) {
        return $this->queryDeUnCui($edificio_id)->getResult();
    }

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
     * devuelve las carreras del establecimiento
     */
    public function findCarreras($establecimiento) {
        return $this->_em->getRepository('OfertaEducativaBundle:Carrera')->findCarrerasPorEstablecimiento($establecimiento);
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
     * Devuelve las salas que tiene el establecimiento, si tiene
     * 
     * @param type $establecimiento
     */
    public function findSalasInicial($establecimiento) {
        $inicial_x = new ArrCol();
        $inicial = $establecimiento->getUnidadEducativa('Ini');
        if ($inicial) {
            $ofertas = $inicial->existeOferta();
            if ($ofertas) {
                $repo = $this->_em
                        ->getRepository('OfertaEducativaBundle:InicialX');
                $inicial_x = $repo->findSalas( $ofertas[0] );
            };
        };
        return $inicial_x;
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
     * devuelve una collection con los apodos de los establecimientos que tienen corhortes cargadas en sus carreras
     */
    public function findTienenCohortes() {
        $dql = "
            select e
            from EstablecimientoBundle:Establecimiento e 
            join e.unidades_educativas ue 
            join ue.ofertas uo 
            join uo.ofertas oe 
            join oe.carrera car 
            join uo.cohortes co 
            order by e.orden";
        $q = $this->_em->createQuery($dql);
        return $q->getResult();
    }

    /**
     * devuelve las unidades_ofertas (las ofertas educativas asociadas a una unidad educativa
     * Tipo es el tipo de oferta. Ej: "carrera"
     * $tipo es una string
     */
    public function findUnidadesOfertas($establecimiento, $tipo) {
        $dql = "
            select uo from EstablecimientoBundle:UnidadOferta uo
            join uo.unidades ue
            join uo.ofertas oe
            join oe." . $tipo . " t 
            where ue.establecimiento=:establecimiento";
        $q = $this->_em->createQuery($dql);
        $q->setParameter('establecimiento', $establecimiento);
        return $q->getResult();
    }

    /**
     * Lista de establecimientos para un combo
     */
    public function combo() {
        return $this->findAllOrdenado('orden');
    }
    /*
     * Invoca al UnidadOfertaRepository. Ver ahí todo el detalle
     * 
     * Devuelve un array con los ingresantes, matriculados y egresador de un año en particular de carreras del terciario
     */
    public function findMatriculaCarrera($anio, $carrera = null, $establecimiento=null){
        return $this->_em->getRepository('EstablecimientoBundle:UnidadOferta')
                ->findMatriculaCarrera($anio, $carrera, $establecimieinto);
    }
}