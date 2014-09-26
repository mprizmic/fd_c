<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\TablaBundle\Entity\Nivel;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadoInterface;
use Fd\OfertaEducativaBundle\Model\AsignarVisitador;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadorInterface;

class OfertaEducativaManager {

    protected $em;
    protected $respuesta;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
    }

    /**
     * Se elimina una carrera y la oferta educativa que le corresponde y la unidad_oferta que le corresponde
     * 
     * FALTA testear si se elimina la oferta educativa correspondiente
     * FALTA testear si se eliminan las orientaciones
     * FALTA borrar unidad_oferta
     * 
     * @param type $flush
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function eliminar(Ofertaeducativa $oferta_educativa, $flush = false) {
        $respuesta = new Respuesta();
        try {
            $this->em->remove($oferta_educativa);
            
            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la oferta exitosamente.');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $respuesta;
    }
    public function getEm() {
        return $this->em;
    }

}

