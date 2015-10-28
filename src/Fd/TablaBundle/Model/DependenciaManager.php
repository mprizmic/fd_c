<?php

namespace Fd\TablaBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Dependencia;

class DependenciaManager {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Crea un nuevo objeto vacío
     * 
     * @return Dependencia
     */
    public static function crearNuevo() {
        return new Dependencia();
    }

    /**
     * Persiste un objeto domicilio y devuelve un objeto con el resultado
     * 
     * @return Respuesta
     */
    public function crear(Dependencia $entity, $flush = true) {

        $respuesta = new Respuesta();

        $em = $this->em;

        try {

            $em->persist($entity);

            if ($flush) {
                $em->flush();
            }

            $respuesta->setObjNuevo($entity);

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la dependencia exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la dependencia. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    public function actualizar($entity, $flush = true) {

        $respuesta = new Respuesta();

        try {

            $this->em->persist($entity);

            if ($flush) {
                $this->em->flush();
            }

            $respuesta->setObjNuevo($entity);

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la dependencia exitosamente');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la nueva dependencia. Verifique los datos y reintente');
        }

        return $respuesta;
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
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la dependencia. Verifique los datos y reintente');
        }

        return $respuesta;
    }

}
