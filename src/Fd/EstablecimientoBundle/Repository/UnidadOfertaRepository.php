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
     * devuelve el establecimiento localizado donde se dicta una unidad oferta
     * El resultado es un objeto establecimiento_edificio
     */
    public function findSedeAnexo(UnidadOferta $unidad_oferta) {

        $loc = $unidad_oferta->getLocalizacion();

        if (!$loc) {
            return new NotFoundHttpException('la uo ' . $unidad_oferta->getId() . ' no tiene localizacion');
        };

        $ee = $loc->getEstablecimientoEdificio();

        if (!$ee) {
            return new NotFoundHttpException('la uo ' . $unidad_oferta->getId() . ' no tiene estab_ed');
        }

        return $ee;
    }

    /**
     * dada una localizacion de un terciario, devuelve array de obj unidad_oferta de todas las carreras que se imparten en esa localizacion
     * Si el 2do parametro es verdadero, devuelve también las cohortes que encuentre
     */
    public function findCarreras(Localizacion $localizacion, $cohortes = false) {

        return $this->findUnidadOferta($localizacion, null, $cohortes);
    }

    /**
     * Dada una localizacion o una carrera me devuelve un array de objetos unidad_oferta donde se imparte esa carrera.
     * Se pueda generar el dato con o sin cohortes
     */
    public function findUnidadOferta(Localizacion $localizacion = null, Carrera $carrera = null, $cohortes = false) {

        return $this->qbUnidadOferta($localizacion, $carrera, $cohortes)->getQuery()->getResult();
    }

    /**
     * Dada una localizacion o una carrera me devuelve el query builder.
     * Se pueda generar el dato con o sin cohortes
     */
    public function qbUnidadOferta($localizacion = null, Carrera $carrera = null, $cohortes = false) {
        $qb = $this->createQueryBuilder('uo')
                ->select('uo')
                ->innerJoin('uo.ofertas', 'oe')
                ->where('true = true');

        if ($carrera) {
            $qb->innerJoin('oe.carrera', 'car');
            $qb->andWhere('car = :carrera');
            $qb->setParameter('carrera', $carrera);
        };

        if ($localizacion) {
            $qb->andWhere('uo.localizacion = :localizacion');
            $qb->setParameter('localizacion', $localizacion);
        }

        if ($cohortes) {
            $qb->leftJoin('uo.cohortes', 'co');
        };

        return $qb;
    }

    /**
     * devuelve el array de turnos de una unidad_oferta agregándole la descripción del turno
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
     * FALTA Se usa en varios lados. Revisado por arriba
     * 
     * devuelve un obj inicial_x con la cabecera de las salas de inicial de una unidad_oferta en particular
     */
//    public function findSalas(UnidadOferta $unidad_oferta) {
//        $inicial_x = $this
//                ->_em
//                ->getRepository('OfertaEducativaBundle:InicialX')
//                ->findSalas($unidad_oferta);
//
//        return $inicial_x;
//    }
}
