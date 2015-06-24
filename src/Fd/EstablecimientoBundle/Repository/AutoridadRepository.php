<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\TablaBundle\Entity\CargoAutoridad;

class AutoridadRepository extends EntityRepository {

    public function findRectores() {

        $q = $this->_em->createQueryBuilder()
                ->select('a')
                ->from('EstablecimientoBundle:Autoridad', 'a')
                ->join('a.cargo_autoridad', 'ca')
                ->where('ca.abreviatura = ?1' )
                ->orderBy('a.apellido')
                ->addOrderBy('a.nombre');
        
        $q->setParameter(1, "REC");

        return $q->getQuery()->getResult();
    }

    /**
     * verifica si una carrera se imparte en una sede/anexo de un establecimiento
     * Si el último parametro es false se devuelve un obj tipo unidad_oferta, si es tru se devuelve un valor booleano
     */
    public function findSeImparte(Localizacion $localizacion, Carrera $carrera, $booleano = true) {
        $unidad_oferta = $this->_em->getRepository('EstablecimientoBundle:UnidadOferta')->findOneBy(
                array(
                    'localizacion' => $localizacion,
                    'ofertas' => $carrera->getOferta(),
                )
        );

        if (!$unidad_oferta) {
            return ( $booleano ? false : $unidad_oferta );
        };
        return ( $booleano ? true : $unidad_oferta );
    }

    /**
     * Devuelve el querybuilder de las localizaciones de los terciarios.
     * Debe ser completado con el select que se desee
     */
    public function qbTerciarios() {
        $qb = $this->_em->createQueryBuilder()
                ->from('EstablecimientoBundle:Localizacion', 'l')
                ->innerJoin('l.establecimiento_edificio', 'ee')
                ->innerJoin('ee.establecimientos', 'e')
                ->innerJoin('l.unidad_educativa', 'ue')
                ->innerJoin('ue.nivel', 'n')
                ->where('n.abreviatura = ?1')
                ->orderBy('e.orden')
                ->addOrderBy('ee.cue_anexo');

        $qb->setParameter(1, 'Ter');
        
        return $qb;
    }
    /**
     * Devuelve una collection de objetos Localizacion con todas las sedes y anexos de los terciarios
     * 
     * @return type
     */
    public function qbTerciariosCompleto(){
        return $this->qbTerciarios()->select('l');
        
    }
    /**
     * devuelve un array de localizaciones de las sedes y anexos en los que se imparten terciarios
     * ordenados por establecimiento y cue_anexo
     * 
     * resultado[][localizacion]
     * resultado[][establecimiento_nombre]
     * resultado[][localizacion_id]
     * resultado[][establecimiento_edificio_nombre]
     */
    public function findTerciarios() {
        $qb = $this->qbTerciarios()
                ->select('l as localizacion')
                ->addSelect('e.apodo as establecimiento_nombre')
                ->addSelect('l.id as localizacion_id')
                ->addSelect('ee.nombre as establecimiento_edificio_nombre');

        $resultado = $qb->getQuery()
                ->getResult();
        return $resultado;
    }

    /**
     * dada una localizacion devuelve todos los turnos que tienen todas las ofertas que en dicha unidad educativa se impartan
     */
    public function findTurnos(\Fd\EstablecimientoBundle\Entity\Localizacion $localizacion) {

        $todos = array();

        foreach ($localizacion->getOfertas() as $key => $unidad_oferta) {

            $parcial = array();

            foreach ($unidad_oferta->getTurnos() as $key2 => $un_turno) {
                $parcial[] = $un_turno->getTurno()->getDescripcion();
            }

            $todos = array_merge($todos, $parcial);
        };

        return array_unique($todos);
    }

    /**
     * dada una carrera devuelve todas sus localizaciones
     */
    public function findDeCarrera(Carrera $carrera) {
        $q = $this->_em->createQueryBuilder()
                ->select('l.id as localizacion_id')
                ->addSelect('e.id as establecimiento_id')
                ->addSelect('ee.cue_anexo as cue_anexo')
                ->addSelect('e.nombre as establecimiento_nombre')
                ->addSelect('ee.nombre as localizacion_nombre')
                ->addSelect('uo.id as unidad_oferta_id')
                ->from('EstablecimientoBundle:Localizacion', 'l')
                ->join('l.establecimiento_edificio', 'ee')
                ->join('ee.establecimientos', 'e')
                ->join('l.ofertas', 'uo')
                ->join('uo.ofertas', 'oe')
                ->where('oe.id= ?1')
                ->orderBy('e.orden')
                ->addOrderBy('ee.cue_anexo')
                ->setParameter(1, $carrera->getOferta()->getId());

        $dql = $q->getDQL();
        $resultado = $q->getQuery()->getResult();
        return $resultado;
    }
}
