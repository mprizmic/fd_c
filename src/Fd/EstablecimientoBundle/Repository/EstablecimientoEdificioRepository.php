<?php

namespace Fd\EstablecimientoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection as ArrCol;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\OfertaEducativaBundle\Entity\InicialX;

class EstablecimientoEdificioRepository extends EntityRepository {

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
        return $this->createQueryBuilder('ee')
                        ->where('ee.establecimientos = ' . $establecimiento->getId())
                        ->orderBy('ee.cue_anexo')
                        ->getQuery()
                        ->getResult();
    }

}
