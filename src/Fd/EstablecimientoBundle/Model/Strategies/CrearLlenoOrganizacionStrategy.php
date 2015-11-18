<?php

namespace Fd\EstablecimientoBundle\Model\Strategies;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;

use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\TablaBundle\Entity\Dependencia;
use Fd\EstablecimientoBundle\Model\Strategies\CrearVacioOrganizacionStrategy;

class CrearLlenoOrganizacionStrategy {
    
    private $establecimiento_edificio_id;
    private $dependencia_id;
    private $em;
    
    public function __construct($establecimiento_edificio_id = null, $dependencia_id = null) {
        
        $this->establecimiento_edificio_id = $establecimiento_edificio_id;
        $this->dependencia_id = $dependencia_id;
    }
    
    public function crear(){
        
        $respuesta = new Respuesta();
        
        $respuesta = CrearVacioOrganizacionStrategy::crear();
        
        $establecimiento = $this->em->getRepository('EstablecimientoBundle:EstablecimientoEdificio')->find($this->establecimiento_edificio_id);
        
        if (!$establecimiento){
            return $respuesta;
        }
        
        $dependencia = $this->em->getRepository('TablaBundle:Dependencia')->find($this->dependencia_id);

        if (!$dependencia){
            return $respuesta;
        }

        $respuesta->setCodigo(1);
        
        $obj = $respuesta->getObjNuevo();
        
        $obj->setEstablecimiento($establecimiento);
        $obj->setDependencia($dependencia);
        
        return $respuesta;
    }
    public function setEstablecimiento( $establecimiento_id ){
        
        $this->establecimiento_edificio_id = $establecimiento_id;
        
    }
    public function setDependencia( $dependencia_id ){
        $this->dependencia_id = $dependencia_id;
    }
    public function setEm( $em ){
        $this->em = $em;
    }
}
