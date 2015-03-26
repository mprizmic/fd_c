<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Repository\InicialXRepository;

class UnidadOfertaRepository extends EntityRepository {

        /**
     * devuelve el establecimiento localizacido donde se dicta una unidad oferta
     * El resultado es un objeto establecimiento_edificio
     */
    public function findSedeAnexo(UnidadOferta $unidad_oferta){
        
        $loc = $unidad_oferta->getLocalizacion();
        
        if (!$loc){
            return new NotFoundHttpException('la uo ' . $unidad_oferta->getId() . ' no tiene localizacion');
        };
         
        $ee = $loc->getEstablecimientoEdificio();
        
        if (!$ee){
            return new NotFoundHttpException('la uo ' . $unidad_oferta->getId() . ' no tiene estab_ed');
        }
        
        return $ee;
    }

    /**
     * dada una localizacion de un terciario, devuelve obj unidad_oferta de todas las carreras que se imparten en esa localizacion
     * Si el 2do parametro es verdadero, devuelve también las cohortes que encuentre
     */
    public function findCarreras(Localizacion $localizacion, $cohortes = false) {

        return $this->findUnidadOferta($localizacion, null, $cohortes);
    }
    /**
     * dada una carrera me devuelve un array de objetos unidad_oferta donde se imparte esa carrera
     */
    public function findUnidadOferta(Localizacion $localizacion = null, Carrera $carrera = null, $cohortes = false ){
        $qb = $this->createQueryBuilder('uo')
                ->select('uo')
                ->innerJoin('uo.ofertas', 'oe')
                ->where('true = true');
        
        if ($carrera){
            $qb->innerJoin('oe.carrera', 'car');
            $qb->andWhere('car = :carrera');
            $qb->setParameter('carrera', $carrera);
        };
        
        if ( $localizacion ){
            $qb->andWhere('uo.localizacion = :localizacion');
            $qb->setParameter('localizacion', $localizacion);
        };
                
        if ( $cohortes ){
                $qb->leftJoin('uo.cohortes', 'co');
        };
        
                
        return $qb->getQuery()->getResult();
    }

    /**
     * devuelve el array de turnos de una unidad_oferta
     */
    public function findTurnosArray(UnidadOferta $unidad_oferta) {
        $parcial = $unidad_oferta->getTurnos();

        if (count($parcial) < 1) {
            return array();
        };

        foreach ($parcial as $key => $value) {
            $resultado[$key] = $value->getTurno()->getDescripcion();
        };

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
     * FALTA ver si no queda DEPRECATED
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
     * FALTA ver si queda DEPRECATED
     * 
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
     * FALTA terminar DEPRECATED?
     * 
     * Devuelve un array con los ingresantes, matriculados y egresador de un año en particular de todas las carreras de un terciario localizado.
     * Si no encontró resultados el array se carga con ceros en todas las posiciones
     */

//    public function findMatriculaCarrera($unidad_oferta, $anio) {
//        
//        //vector de claves del array de resultado. Se usa si el resultado es un array vacio
//        $keys = array('anio', 'matricula', 'matricula_ingresantes', 'egreso');
//        
//        foreach ($unidad_oferta->getCohortes() as $key => $un_anio) {
//            if ($un_anio->getAnio)
//            
//        }
//
//        $qb = $this->_em->createQueryBuilder()
//                ->select('co.anio, co.matricula, co.matricula_ingresantes, co.egreso')
//                ->from('EstablecimientoBundle:UnidadOferta', 'uo')
//                ->innerJoin('uo.localizacion', 'l')
//                ->leftJoin('uo.cohortes', 'co')
//                ->where('l.')
//                ->where('co.anio = :anio');
//                ->
//        $qb->setParameter('anio', $anio);
//
//        $dql = $qb->getDQL();
//
//        $unidades_ofertas = $qb->getQuery()->getArrayResult();
//
//        if (count($unidades_ofertas) == 0) {
//            $unidades_ofertas[] = $this->limpiar_array($keys, 0);
//        };
//
//        //se pasan los datos a un array
//
//        return $unidades_ofertas;
//    }
//
//    public function limpiar_array($keys, $valor) {
//        return array_fill_keys($keys, $valor);
//    }

}
