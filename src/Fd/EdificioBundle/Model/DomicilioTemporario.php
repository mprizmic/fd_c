<?php
namespace Fd\EdificioBundle\Model;

/**
 * Cuando se crea un nuevo edificio se dispara un evento que a través de un servicio genera este domicilio 
 * para el edificio nuevo.
 * El domicilio se crea como principal porque se está creando el edificio
 */
use Doctrine\ORM\EntityManager;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\EdificioBundle\Entity\Edificio;

class DomicilioTemporario {
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function crearTemporario(Edificio $edificio) {
        $domicilio = new Domicilio();
        $domicilio->setEdificio($edificio);
        
        $domicilio->setCalle('Ingrese la calle');
        $domicilio->setAltura(99);
        $domicilio->setPrincipal(TRUE);

        $this->em->persist($domicilio);
        $this->em->flush();
        
        return $domicilio;
    }

}