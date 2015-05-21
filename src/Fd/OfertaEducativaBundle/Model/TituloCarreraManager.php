<?php

/**
 * 
 */

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\TituloCarrera;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadoInterface;
use Fd\OfertaEducativaBundle\Model\AsignarVisitador;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadorInterface;

class TituloCarreraManager {

    protected $em;
    protected $respuesta;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
    }


    /**
     * Vincula o desvincular un titulo_carrera a una carrera
     * 
     */
    public function vincular_a_carrera(Carrera $carrera, TituloCarrera $titulocarrera, $accion, $flush = false) {
        
        $respuesta = new Respuesta();

        if ($accion == 'vincular') {
            $titulocarrera->vincularCarrera($carrera, true);
        } else {
            $titulocarrera->vincularCarrera($carrera, false);
        };

        $this->getEm()->persist($titulocarrera);

        if ($flush) {
            try {
                $this->getEm()->flush();

                $respuesta->setCodigo(1);
                $respuesta->setMensaje('Se vinculó el título a la carrera exitosamente');
            } catch (Exception $ex) {
                $respuesta->setCodigo(2);
                $respuesta->setMensaje('Problemas al tratar de vincular el título. Verifique y reintente.');
            }
        };

        return $respuesta;
    }

    /**
     * DEPRECATED
     * 
     * desvincular una norma a una carrera 
     * 
     * @return type
     */
//    public function desvincularNorma() {
//        if ($flush) {
//            try {
//                $this->getEm()->flush();
//
//                $respuesta->setCodigo(1);
//                $respuesta->setMensaje('Se desvinculó la norma exitosamente');
//            } catch (Exception $ex) {
//                $respuesta->setCodigo(2);
//                $respuesta->setMensaje('Problemas al tratar de desvincular la norma. Verifique y reintente.');
//            }
//        };
//
//        return $respuesta;
//    }

    public function getEm() {
        return $this->em;
    }

}
