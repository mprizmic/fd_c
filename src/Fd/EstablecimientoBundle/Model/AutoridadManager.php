<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\Autoridad;

class AutoridadManager {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Crea un nuevo objeto vacío
     * 
     * @return Dependencia
     */
    public static function crearVacio() {
        return new Autoridad();
    }

    /**
     * Persiste un objeto y devuelve un objeto con el resultado
     * 
     * @return Respuesta
     */
    public function crear($entity, $flush = true) {

        $respuesta = new Respuesta();

        $em = $this->em;

        try {

            $em->persist($entity);

            if ($flush) {
                $em->flush();
            }

            $respuesta->setObjNuevo($entity);

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la autoridad exitosamente');
        } finally {
            return $respuesta;
        };
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        $em = $this->em;

        try {
            $em->remove($entity);

            if ($flush) {
                $em->flush();
            }

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la dependencia exitosamente');
        } finally {
            return $respuesta;
        }
    }

}
