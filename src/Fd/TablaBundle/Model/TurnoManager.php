<?php

namespace Fd\TablaBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimietoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Turno;

class TurnoManager {

    private $em;
    private $respuesta;

    public function __construct(EntityManager $em) {

        $this->em = $em;
    }

    public function crearVacio() {
        return new Turno();
    }

    /**
     * Devuelve un objeto del turno seleccionado. Si el parametro pasado es  vacío se crea un turno TM
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
}
