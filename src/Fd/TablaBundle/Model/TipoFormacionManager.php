<?php

namespace Fd\TablaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
//use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\TipoFormacion;
use Fd\TablaBundle\Repository\TipoFormacionRepository;

class TipoFormacionManager  {

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
        return new TipoFormacion();
    }
    /**
     * Devuelve un objeto del tipo de formacion seleccionado. Si el parametro pasa vacío se crea un estado FD
     */
    public function crearLleno($tipo_formacion = null) {
        if (!$tipo_formacion){
            $tipo_formacion = 'FD';
        };
        
        $tipo_formacion = $this->em->getRepository('TablaBundle:TipoFormacion')->findBy(array('codigo' => $tipo_formacion));
        
        return $tipo_formacion[0];
        
    }    


}
