<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Repository\InicialXRepository;

class UnidadOfertaRepository extends EntityRepository {

    /**
     * devuelve el array de turnos de una unidad_oferta
     */
    public function findTurnosArray(UnidadOferta $unidad_oferta){
        $parcial = $unidad_oferta->getTurnos();
        
        if (count($parcial) < 1){
            return array();
        };
        
        foreach ($parcial as $key => $value) {
            $resultado[$key] = $value->getTurno()->getDescripcion();
        };
        
//        $resultado = array_unique($repetidos, SORT_LOCALE_STRING);
        
        return $resultado;
        
    }
    /**
     * devuelve un obj inicial_x con la cabecera de las salas de inicial de una unidad_oferta en particular
     */
    public function findSalas(UnidadOferta $unidad_oferta) {
        $inicial_x = $this
                ->_em
                ->getRepository('OfertaEducativaBundle:InicialX')
                ->findSalas($unidad_oferta);
        
        return $inicial_x;
    }

    /**
     * devuelve las ofertas carrera de un establecimiento que tienen cohortes
     */
    public function findCarrerasConCohortes($establecimiento_id) {

        $dql = "
            select uo
            from EstablecimientoBundle:UnidadOferta uo
            join uo.ofertas oe 
            join oe.carrera car 
            join uo.cohortes co
            join uo.unidades u
            join u.establecimiento e
            where e.id=:establecimiento
            order by car.nombre";
        $q = $this->_em->createQuery($dql);
        $q->setParameter('establecimiento', $establecimiento_id);
        return $q->getResult();
    }

    /**
     * devuelve una collection de objetos unidad_oferta (las ofertas educativas asociadas a una unidad educativa)
     * de una carrera en particular
     */
    public function findUnidadesOfertas($carrera) {
        $dql = "
            select uo from EstablecimientoBundle:UnidadOferta uo
            join uo.unidades ue
            join ue.establecimiento e
            join uo.ofertas oe
            join oe.carrera c 
            where c.id = :carrera";
        $q = $this->_em->createQuery($dql);
        $q->setParameter('carrera', $carrera);
        return $q->getResult();
    }

    /**
     * PASO AL HANDLER TANTO PARA INICIAL COMO PARA TERCIARIO
     * 
     * crea un registro de unidad_oferta
     * tiene funcionamiento diferente al create del Backend.
     * Aquí recibe los parámetros para su creación
     * 
     * @param type $oferta
     * @param type $unidad
     */
    public function crear($unidad, $oferta) {
//        $respuesta = new Respuesta();
//
//        $em = $this->getEntityManager();
//
//        $entity = new UnidadOferta();
//        $entity->setOfertas($oferta);
//        $entity->setUnidades($unidad);
//
//        try {
//            $em->persist($entity);
//            $em->flush();
//
//            $respuesta->setCodigo(1);
//            $respuesta->setMensaje('Se generó la oferta educativa para el establecimiento seleccionado.');
//        } catch (Exception $e) {
//            $respuesta->setCodigo(2);
//            $respuesta->setMensaje('No se pudo generar la oferta educativa. Verifíquelo y reintente.');
//        };
//        return $respuesta;
    }

    /**
     * PASO AL HANDLER TANTO PARA INICIAL COMO PARA TERCIARIO
     * 
     * elimina un registro de unidad_oferta
     * tiene funcionamiento diferente al create del Backend.
     * Aquí recibe los parámetros para su creación
     * 
     */
    public function eliminar($entity) {
//        $respuesta = new Respuesta();
//
//        $em = $this->getEntityManager();
//
//        try {
//            $em->remove($entity);
//            $em->flush();
//
//            $respuesta->setCodigo(1);
//            $respuesta->setMensaje('Se eliminó la oferta educativa para el establecimiento seleccionado.');
//        } catch (Exception $e) {
//            $respuesta->setCodigo(2);
//            $respuesta->setMensaje('No se pudo eliminar la oferta educativa. Verifíquelo y reintente.');
//        };
//        return $respuesta;
    }

    /**
     * dado un terciario de un establecimiento devuelve un querybuilder para 
     * recuperar los objetos de tipo unidad_oferta 
     * de las ofertas de carreras del establecimiento
     * 
     * @return type resultados objetos unidad_oferta correspondientes a las ofertas de carreras existentes
     */
    public function qbCarrerasPorEstablecimiento($unidad_educativa_id = null) {

        $qb = $this->createQueryBuilder('uo')
                ->join('uo.unidades', 'ue')
                ->join('uo.ofertas', 'oe')
                ->join('oe.carrera', 'c')
                ->where('ue.id = :unidad_educativa')
                ->setParameter('unidad_educativa', $unidad_educativa_id)
        ;
        return $qb;
    }

    /*
     * Devuelve un array con los ingresantes, matriculados y egresador de un año en particular de carreras del terciario
     * Si la carrera está informada, se agrega dicho filtro.
     * Si el establecimiento está informado, se agrega dicho filtro
     * Pueden estar los 2, ninguno o uno de los 2.
     * Si no encontró resultados el array se carga con ceros en todas las posiciones
     */

    public function findMatriculaCarrera($anio, $carrera_id = null, $establecimiento_id = null) {
        //vector de claves del array de resultado. Se usa si el resultado es un array vacio
        $keys = array('anio', 'matricula', 'matricula_ingresantes', 'egreso');

        $qb = $this->createQueryBuilder('uo')
                ->select('co.anio, co.matricula, co.matricula_ingresantes, co.egreso')
                ->innerJoin('uo.unidades', 'ue')
                ->innerJoin('uo.ofertas', 'oe')
                ->innerJoin('oe.carrera', 'car')
                ->innerjoin('uo.cohortes', 'co')
                ->innerJoin('ue.establecimiento', 'e')
                ->where('co.anio = :anio');
        $qb->setParameter('anio', $anio);

        //el establecimiento puede o no estar presente
        if ($establecimiento_id) {
            $keys = array_merge($keys, array('establecimiento_id'));

            $qb->addSelect('e.id as establecimiento_id, e.apodo');
            $qb->andWhere('ue.establecimiento = :establecimiento');
            $qb->setParameter('establecimiento', $establecimiento_id);
        };
        if ($carrera_id) {
            $keys = array_merge($keys, array('carrera_id'));

            $qb->addSelect('car.id as carrrera_id', 'car.nombre');
            $qb->andWhere('car.id = :carrera');
            $qb->setParameter('carrera', $carrera_id);
        };
        $dql = $qb->getDQL();
        $unidades_ofertas = $qb->getQuery()->getArrayResult();

        if (count($unidades_ofertas) == 0) {
            $unidades_ofertas[] = $this->limpiar_array($keys, 0);
        };

        //se pasan los datos a un array

        return $unidades_ofertas;
    }

    public function limpiar_array($keys, $valor) {
        return array_fill_keys($keys, $valor);
    }

}
