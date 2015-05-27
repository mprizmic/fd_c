<?php

namespace Fd\EdificioBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;

class DomicilioLocalizacionManager {
    
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    /**
     * Persiste un objeto domicilio_localizacion y devuelve un código con el resultado
     * 
     * @param Localizacion $localizacion
     * @param Domicilio $domicilio
     * @return Respuesta
     */
    public function crear(Localizacion $localizacion, Domicilio $domicilio) {

        $respuesta = new Respuesta();
        $em = $this->em;

        try {
            $dl = new DomicilioLocalizacion();
            $dl->setDomicilio($domicilio);
            $dl->setLocalizacion($localizacion);
            $em->persist($dl);
            $em->flush();

            $respuesta->setClaveNueva($dl->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la relación entre la localización y el domicilio exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la relación entre la localización y el domicilio. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    public function eliminar(DomicilioLocalizacion $entity) {
        $respuesta = new Respuesta();
        $em = $this->_em;
        try {
            $em->remove($entity);
            $em->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la relación entre la localización y los domicilios exitosamente');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la relación entre la localización y los domicilios. Verifique los datos y reintente');
        }

        return $respuesta;
    }




    /**
     * Cambia el domicilio a predeterminado
     * 
     * @param type $domicilio_localizacion
     */
//    public function establecerPredeterminado($domicilio_localizacion) {
//        $valor = TRUE;
//        $this->cambiarPredeterminado($domicilio_localizacion, $valor);
//        return;
//    }
    /**
     * Cambia el domicilio a no predeterminado
     * 
     * @param type $domicilio_localizacion
     * @return type
     */
//    public function cancelarPredeterminado( $domicilio_localizacion ){
//        $valor = FALSE;
//        $this->cambiarPredeterminado($domicilio_localizacion, $valor);
//        return;
//    }
    /**
     * Cambia el estado del campo principal de la entidad pasada como parametro
     * 
     * @param type $entity
     * @param type $valor
     */
//    private function cambiarPredeterminado($entity, $valor) {
//        $entity->setPrincipal($valor);
//        $this->_em->persist($entity);
//        $this->_em->flush();
//        return;
//    }

}
