<?php

namespace Fd\EdificioBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;

class DomicilioManager {
    
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    /**
     * Persiste un objeto domicilio y devuelve un objeto con el resultado
     * 
     * @return Respuesta
     */
    public function crear($entity, $edificio = null) {
        
        $respuesta = new Respuesta();
        $em = $this->em;

        try {
            if ($edificio){
                $entity->setEdificio($edificio);
                $entity->setPrincipal(TRUE);
            }
            
            $em->persist($entity);
            $em->flush();

            //DEPRECATED
            $respuesta->setClaveNueva($entity->getId());
            
            $respuesta->setObjNuevo($entity);

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó el domicilio exitosamente');
            
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar el domicilio. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    public function eliminar(DomicilioLocalizacion $entity) {
//        $respuesta = new Respuesta();
//        $em = $this->_em;
//        try {
//            $em->remove($entity);
//            $em->flush();
//
//            $respuesta->setCodigo(1);
//            $respuesta->setMensaje('Se eliminó la relación entre la localización y los domicilios exitosamente');
//        } catch (Exception $e) {
//            $respuesta->setCodigo(2);
//            $respuesta->setMensaje('No se pudo guardar la relación entre la localización y los domicilios. Verifique los datos y reintente');
//        }
//
//        return $respuesta;
    }
}
