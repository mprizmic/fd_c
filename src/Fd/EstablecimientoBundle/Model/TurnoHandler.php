<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimietoBundle\Entity\Respuesta;
use Fd\EstablecimietoBundle\Entity\TurnoUnidadEducativa;
//use Fd\TablaBundle\Entity\Nivel;

class TurnoHandler {

    protected $em;
    private $unidad_educativa;
    private $respuesta;

    public function getEm() {
        return $this->em;
    }

    public function __construct(UnidadEducativa $unidad_educativa, EntityManager $em) {

        $this->em = $em;
        $this->unidad_educativa = $unidad_educativa;
    }

    public function getUnidadEducativa() {

        return $this->unidad_educativa;
    }

    /*
     * elimina todos los registros de turno_unidad_educativa de una unidad educativa
     */
    public function eliminar() {
        $em = $this->getEm();
        try {
            $turnos = $this->unidad_educativa->getTurnos();
            foreach ($turnos as $turno) {
                $this->unidad_educativa->removeTurno($turno);
                $em->remove($turno);
            };
            $this->getEm()->flush();
            
            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('Se eliminaron los turnos de la unidad educativa exitosamente.');
        } catch (Exception $e) {
            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        };
        return $this->respuesta;
    }

}