<?php

namespace Fd\ActoPublicoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;

class ActoPublicoManager {

    protected $em;
    protected $respuesta;
    protected $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
        $this->repository = $this->em->getRepository('ActoPublicoBundle:ActoPublico');
    }

    public function getEm() {
        return $this->em;
    }
    public function getRepository(){
        return $this->repository;
    }
    /**
     * borra tdos los registro del archivo
     * @return type 
     */
    public function truncar() {
        $this->getRepository()->truncar();
        return;
    }

}

