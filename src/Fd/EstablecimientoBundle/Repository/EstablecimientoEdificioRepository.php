<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection as ArrCol;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\OfertaEducativaBundle\Entity\InicialX;

class EstablecimientoEdificioRepository extends EntityRepository {

    /**
     * Devuelve la lista de edificio_establecimiento con el inspector de infraestructura indicado
     */
    public function qbInspectores() {
        $qb = $this->createQueryBuilder('ee')
                ->select('e.apodo as apodo')
                ->addSelect('ee.cue_anexo as anexo')
                ->addSelect('ins.nombre as nombre')
                ->addSelect('ins.apellido as apellido')
                ->addSelect('ins.te as te')
                ->addSelect('ins.email as email')
                ->addSelect('d.calle as calle')
                ->addSelect('d.altura as altura')
                ->join('ee.establecimientos', 'e')
                ->join('ee.edificios', 'ed')
                ->join('ed.inspector', 'ins')
                ->join('ed.domicilios', 'd')
                ->where('d.principal = ?1')
                ->orderBy('e.apodo')
                ->addOrderBy('ee.cue_anexo');
        return $qb->setParameter('1', true);
    }

    /**
     * devuelve la query para preguntar por todos los alumnos ordenados alfabeticamente por apellido y nombre
     */
    public function queryDeUnCui($edificio) {
        $dql = 'select ee
            from EstablecimientoBundle:EstablecimientoEdificio ee
            join ee.edificios ed
            join ee.establecimientos e
            where ed.id = :edificio 
            order By e.orden, ee.cue_anexo';

        $q = $this->_em->createQuery($dql);
        $q->setParameter('edificio', $edificio);
        return $q;
    }

    /**
     * devuelve todos los edificios de un establecimiento
     */
    public function findDeUnCui($edificio) {
        return $this->queryDeUnCui($edificio)->getResult();
    }

    public function findAllOrdenado() {
        $qb = $this->createQueryBuilder('ee')
                ->innerJoin('ee.establecimientos', 'e')
                ->orderBy('e.orden', 'ASC')
                ->addOrderBy('ee.cue_anexo', 'ASC');

        return $qb->getQuery()->getResult();
    }

    /**
     * devuelve un objeto unidad educativa del nivel solicitado
     * null en caso de que en dicha localizacion no funcione el nivel solicitado
     */
    public function findUnidadEducativaLocalizada(EstablecimientoEdificio $establecimiento_edificio, $nivel) {

        $unidad_educativa = null;

        $localizaciones = $establecimiento_edificio->getLocalizacion();
        foreach ($localizaciones as $localizacion) {
            $unidad_educativa = $localizacion->getUnidadEducativa();
            if ($unidad_educativa->getNivel()->getAbreviatura() == $nivel) {
                break;
            };
        }
        return $unidad_educativa;
    }

    /**
     * Devuelve las salas de incicial que tiene el establecimiento en una determinada localizacion
     * null si no tiene ninguna
     * 
     * @param type $establecimiento_edificio
     */
    public function findSalasInicial(EstablecimientoEdificio $establecimiento_edificio) {
        $inicial_x = new ArrCol();

        //obj unidad_educativa
        $unidad_educativa_nivel_inicial = $establecimiento_edificio->getUnidadEducativaLocalizada('Ini');

        $unidad_oferta_nivel_inicial = $establecimiento_edificio->findUnidadOfertaDelNivel('Ini');

        if ($inicial) {
            $ofertas = $inicial->existeOferta();
            if ($ofertas) {
                $repo = $this->_em
                        ->getRepository('OfertaEducativaBundle:InicialX');
                $inicial_x = $repo->findSalas($ofertas[0]);
            };
        };
        return $inicial_x;
    }

    /**
     * devuelve un arraycollection de obj unidad_oferta de un nivel determinado
     * @param string $nivel la abreviatura del nivel
     */
    public function findUnidadOfertaDelNivel(EstablecimientoEdificio $establecimiento_edificio, $nivel) {
        $unidad_ofertas = null;

        foreach ($establecimiento_edificio->getLocalizacion() as $localizacion) {
            if ($localizacion->getUnidadEducativa()->getNivel()->getAbreviatura() == $nivel) {
                $unidad_ofertas = $localizacion->getOfertas();

                break;
            };
        }
        return $unidad_ofertas;
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
     * devuelve los establecimiento_edificios de un establecimiento ordenados por anexo
     * 
     * @return arraycollection de Edificio
     */
    public function findEdificios($establecimiento) {
        return $this->qbEdificios($establecimiento)
                        ->getQuery()
                        ->getResult();
    }

    public function qbEdificios($establecimiento) {
        return $this->createQueryBuilder('ee')
                        ->where('ee.establecimientos = ' . $establecimiento->getId())
                        ->orderBy('ee.cue_anexo');
    }

    public function findSedeYAnexo($establecimiento) {
        return $this->qbEdificios($establecimiento)
                        ->andWhere("ee.cue_anexo <> '99'")
                        ->getQuery()
                        ->getResult();
    }

    /**
     * Devuelve array de las orientaciones de la NES en el establecimiento_edificio
     * Si no tiene devuelve array vacío
     */
    public function findMediaOrientaciones(EstablecimientoEdificio $establecimiento_edificio) {
        $qb = $this->createQueryBuilder('ee')
                ->select(array(
                    'mo.nombre as orientacion',
                ))
                ->innerJoin('ee.localizacion', 'l')
                ->innerJoin('l.ofertas', 'uo')
                ->innerJoin('uo.secundario', 'sx')
                ->innerJoin('sx.orientaciones', 'ori')
                ->innerJoin('ori.orientacion', 'mo')
                ->where('ee.id = :establecimiento_edificio')
                ->orderBy('mo.nombre');

        $qb->setParameter('establecimiento_edificio', $establecimiento_edificio);
        $resultado = $qb->getQuery()->getArrayResult();
        return $resultado;
    }

}
