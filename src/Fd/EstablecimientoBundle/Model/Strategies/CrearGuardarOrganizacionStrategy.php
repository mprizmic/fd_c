<?php

namespace Fd\EstablecimientoBundle\Model\Strategies;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;

class CrearGuardarOrganizacionStrategy {

    private $oi;
    private $flush;
    private $em;

    public function __construct() {
        $this->flush = true;
    }

    public function crear() {

        $respuesta = new Respuesta();

        try {
            $this->em->persist($this->oi);

            if ($this->flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('La organización interna se actualizó correctamente');
            $respuesta->setObjNuevo($this->oi);
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
        }
        return $respuesta;
    }

    public function setOrganizacion(OrganizacionInterna $organizacion) {

        $this->oi = $organizacion;
    }

    public function setFlush($flush) {

        $this->flush = $flush;
    }

    public function setEm($em) {
        $this->em = $em;
    }

}
