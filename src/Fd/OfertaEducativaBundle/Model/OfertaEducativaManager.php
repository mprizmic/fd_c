<?php

/**
 * servicio ofertaeducativa.ofertaeducativa.manager
 */

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadoInterface;
use Fd\OfertaEducativaBundle\Model\AsignarVisitador;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadorInterface;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Model\NivelManager;

class OfertaEducativaManager {

    protected $em;
    protected $respuesta;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
    }

    /**
     * crea un registro de oferta_educativa con el nivel incluido
     * Se crea con el tipo de oferta vacio
     * 
     * Deuelve el objeto nuevo o null
     * 
     * @param type $nivel
     */
    public function crearLlena(Nivel $nivel) {
        $respuesta = new Respuesta();

        $nivel_manager = new NivelManager($this->em);
        $nivel = $nivel_manager->crearLleno('Ter');

        //se genera la oferta educativa
        $oferta = new OfertaEducativa();
        $oferta->setNivel($nivel);

        try {

            $this->em->persist($oferta);

            return $oferta;
        } catch (Exception $ex) {

            return null;
        }
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

    /**
     * Vincula o desvincular una norma a un oferta educativa
     * 
     * @param \Fd\OfertaEducativaBundle\Entity\OfertaEducativa $oferta_educativa
     * @param type $norma
     * @param type $flush
     * @return type
     */
    public function vincularNorma(OfertaEducativa $oferta_educativa, $norma, $accion, $flush = false) {
        $respuesta = new Respuesta();

        if ($accion == 'vincular') {
            $oferta_educativa->vincularNorma($norma);
        } else {
            $oferta_educativa->removeNorma($norma);
        };

        $this->getEm()->persist($oferta_educativa);

        if ($flush) {
            try {
                $this->getEm()->flush();

                $respuesta->setCodigo(1);
                $respuesta->setMensaje('Se actualizó la norma exitosamente');
            } catch (Exception $ex) {
                $respuesta->setCodigo(2);
                $respuesta->setMensaje('Problemas al tratar de actualizar la norma. Verifique y reintente.');
            }
        };

        return $respuesta;
    }

    /**
     * desvincular una norma a una carrera 
     * 
     * @return type
     */
    public function desvincularNorma() {
        if ($flush) {
            try {
                $this->getEm()->flush();

                $respuesta->setCodigo(1);
                $respuesta->setMensaje('Se desvinculó la norma exitosamente');
            } catch (Exception $ex) {
                $respuesta->setCodigo(2);
                $respuesta->setMensaje('Problemas al tratar de desvincular la norma. Verifique y reintente.');
            }
        };

        return $respuesta;
    }

    public function getEm() {
        return $this->em;
    }

}
