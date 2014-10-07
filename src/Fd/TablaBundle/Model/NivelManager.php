<?php

namespace Fd\TablaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
//use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Repository\NivelRepository;

class NivelManager  {

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
        return new Nivel();
    }
    /**
     * Devuelve un objeto del nivel señeccionado.
     * @param type $nivel
     * @return type
     */
    public function crearLleno($nivel) {
        $nivel = $this->em->getRepository('TablaBundle:Nivel')->findBy(array('abreviatura' => $nivel));
        return $nivel[0];
        
    }    


}
