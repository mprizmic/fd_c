<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\TablaBundle\Entity\Nivel;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Model\InicialXHandler;
use Fd\OfertaEducativaBundle\Repository\InicialXRepository;

class UnidadOfertaInicialHandler {

//    private $ue;
    private $em;

    public function __construct($em) {
        $this->em = $em;
    }

    private function getEm() {
        return $this->em;
    }

    /*
     * FALTA testear
     * se crea el registro en Unidad_oferta para el nivel inicial
     * 
     * Se llama al handler que crea el registro en Inicial_x
     */

    public function crear(Localizacion $localizacion = null, OfertaEducativa $oferta_educativa = null) {

        if (!$oferta_educativa) {
            // si la oferta_educativa no se informa se recupera la de nivel inicial
            $dql = "select oe from OfertaEducativaBundle:OfertaEducativa oe join oe.nivel n where n.abreviatura = :nivel";
            $q = $this->getEm()->createQuery($dql);
            $q->setParameter('nivel', 'Ini');
            $oferta_educativa = $q->getSingleResult();
        }

        //creo la unidad_oferta
        $uo = new UnidadOferta();
        $uo->setOfertas($oferta_educativa);
        $uo->setLocalizacion($localizacion);
        
        $this->getEm()->persist($uo);

        $inicial_x_handler = new InicialXHandler($this->getEm());
        $inicial_x = $inicial_x_handler->crear($uo, 0);

        $this->getEm()->flush();

        return $uo;
    }

    /**
     * FALTA revisar para ver si anda
     * 
     * @param Localizacion $localizacion
     * @return type
     */
    public function eliminarAll(Localizacion $localizacion) {
        $respuesta = new Respuesta();
        try {
            /*
             * primero se elimina las salas de inicial_x. Luego se elimina inicial_x y luego unidad_oferta
             */
            $unidad_oferta = $unidad_educativa->getOfertas()[0];

            //se busca inicial_x. No hay relacion de unidad_oferta a inicial_x
            $inicial_x = $this->getEm()->getRepository("OfertaEducativaBundle:InicialX")->findSalas($unidad_oferta);

            //creo el handler
            $inicial_x_handler = new InicialXHandler($this->getEm());
            $respuesta = $inicial_x_handler->eliminar($inicial_x);

            //si en el handler no hubo problemas sigo adelante
            if ($respuesta->getCodigo() == 1) {
                $this->getEm()->remove($unidad_oferta);

                $this->getEm()->flush();
            };
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $respuesta;
    }

}
