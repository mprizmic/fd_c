<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Repository\OrganizacionInternaRepository;

class OrganizacionInternaManager  {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    /**
     * Crea un nuevo objeto vacío
     * 
     * @return OrganizacionInterna
     */
    public static function crearVacio(){
        return new OrganizacionInterna();
    }
    /**
     * @return type
     */
    public function crearLleno($organizacion_interna) {
    }    


}


