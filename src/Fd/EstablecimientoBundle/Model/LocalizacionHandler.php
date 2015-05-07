<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Model\NivelManager;

class LocalizacionHandler {

    protected $em;
    protected $strategy;
    protected $strategy_instance;
    protected $nivel;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    /**
     * Actualiza un registro de la tabla.
     * 
     * @param type $entity
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($entity, $flush = null) {
        $respuesta = new Respuesta();

        try {
            $this->em->persist($entity);
            
            if ($flush){
                $this->em->flush();
                $respuesta->setClaveNueva($entity->getId());
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó  exitosamente la información de la localización de la unidad educativa dle establecimiento');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar. Verifique los datos y reintente');
        }

        return $respuesta;
    }
}