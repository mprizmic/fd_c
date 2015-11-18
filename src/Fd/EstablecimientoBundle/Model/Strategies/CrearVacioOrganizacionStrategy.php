<?php

namespace Fd\EstablecimientoBundle\Model\Strategies;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;

use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\TablaBundle\Entity\Dependencia;

class CrearVacioOrganizacionStrategy {
    
    public static function crear(){
        
        $respuesta = new Respuesta();
        
        $respuesta->setCodigo(1);
        
        $respuesta->setObjNuevo(new OrganizacionInterna());
        
        return $respuesta;
    }
}
