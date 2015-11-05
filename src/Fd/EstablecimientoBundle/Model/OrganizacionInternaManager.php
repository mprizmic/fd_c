<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Repository\OrganizacionInternaRepository;

class OrganizacionInternaManager {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Crea un nuevo objeto vacío
     * 
     * @return OrganizacionInterna
     */
    public static function crearVacio() {
        return new OrganizacionInterna();
    }

    /**
     * @return type
     */
    public function crear($organizacion_interna, $flush = true) {

        $respuesta = new Respuesta(2, 'No se pudo generar la dependencia');


        // no se pone catch por que sólo genera un cartel que ya general por default Respuesta
        try {
            $this->em->persist($organizacion_interna);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('La dependencia se actualizó correctamente');
            $respuesta->setObjNuevo($entity);
        } finally {

            return $respuesta;
        }
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        try {

            $this->em->remove($entity);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la dependencia exitosamente.');
        } finally {

            return $respuesta;
        }
    }

}
