<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimietoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Turno;

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

    public function crearVacio() {
        return new Turno();
    }

    /**
     * Devuelve un objeto del turno seleccionado. Si el parametro pasa vacío se crea un turno TM
     * @param type $nivel
     * @return type
     */
    public function crearLleno($turno = null) {
        if (!$turno){
            $turno = 'TM';
        };
        
        $turno = $this->em->getRepository('TablaBundle:Turno')->findBy(array('codigo' => $turno));
        
        return $turno[0];
        
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
