<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\PlantelEstablecimientoManager;

class AutoridadManager {

    protected $em;
    protected $plantel;

    public function __construct(EntityManager $em, PlantelEstablecimientoManager $plantel) {
        $this->em = $em;
        $this->plantel = $plantel;
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
        } catch (\Exception $e) {

            $respuesta->setMensaje('No se pudo guardar la dependencia. Verifique los datos y reintente');

            if ($e->getPrevious()->getCode() == 23000) {
                $respuesta->setMensaje('El cargo ya está en uso. Debería usar o crear otro.');
            };
        };
        return $respuesta;
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        $em = $this->em;

        try {
            //se anula la relación con la tabla plantel_establecimiento. Si no se anula trataría de dar de baja el registro de dicha tabla.
            $entity->setCargo(null);

            $em->remove($entity);

            if ($flush) {
                $em->flush();
            }

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la dependencia exitosamente');
        } catch (Exception $e) {
            $respuesta->setMensaje('No se pudo eliminar la dependencias');
        }
        return $respuesta;
    }

    public function desasignar($entity, $flush = true) {
        $respuesta = new Respuesta();

        try {
            $entity->setCargo(null);

            $this->em->persist($entity);

            if ($flush) {
                $this->em->flush();
            }

            $respuesta->setObjNuevo($entity);
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la autoridad exitosamente');
            
        } catch (Exception $ex) {
            
            $respuesta->setMensaje('No se pudo eliminar la dependencias');
        };
        
        return $respuesta;
    }

}
