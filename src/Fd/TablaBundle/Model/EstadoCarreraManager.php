<?php

namespace Fd\TablaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
//use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\EstadoCarrera;
use Fd\TablaBundle\Repository\EstadoCarreraRepository;

class EstadoCarreraManager  {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    /**
     * Crea un nuevo objeto vacío
     * 
     * @return Carrera
     */
    public function crearVacío(){
        return new EstadoCarrera();
    }
    /**
     * Devuelve un objeto del estado seleccionado. Si el parametro pasa vacío se crea un estado ACTIVO
     * @param type $nivel
     * @return type
     */
    public function crearLleno($estado = null) {
        if (!$estado){
            $estado = 'ACT';
        };
        
        $estado = $this->em->getRepository('TablaBundle:EstadoCarrera')->findBy(array('codigo' => $estado));
        
        return $estado[0];
        
    }    


}
