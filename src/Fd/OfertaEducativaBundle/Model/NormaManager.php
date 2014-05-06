<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Norma;

class NormaManager {

    protected $em;
    protected $respuesta;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
    }

    /**
     * FALTA testear
     * 
     * @param type $entity
     * @return type 
     */
    public function actualizar($entity, $grabar = true) {
        try {
            $this->getEm()->persist($entity);

            if ($grabar) {
                $this->getEm()->flush();
            };

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('La norma se actualizó correctamente');
            $this->respuesta->setClaveNueva($entity->getId());
        } catch (Exception $e) {

            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas en la actualización de la norma');

            return $this->respuesta;
        }
        return $this->respuesta;
    }

    /**
     * @param type $entity
     * @return type 
     */
    public function crear($entity) {
        try {
            $this->em->persist($entity);
            $this->em->flush();

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('La norma se creó correctamente');
            $this->respuesta->setClaveNueva($entity->getId());
        } catch (Exception $e) {

            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas en la creación de la norma');

            return $this->respuesta;
        }
        return $this->respuesta;
    }

    public function desvincular_norma() {
        
    }

    /*
     * Testeado que elimina las referencias de normas
     * 
     * FALTA testear que se elimine si hay una referencia a una oferta educativa
     */

    public function eliminar($entity, $flush = false) {

        $respuesta = new Respuesta();

        try {
            //la norma tiene relacion con la oferta educativa
            //capturo la oferta que hay que eliminar. 
            $ofertas = $entity->getOfertas();

            //Voy a borrar desde el lado propietario de la relacion
            //desengancho normas y oferta educativa
            foreach ($ofertas as $oferta) {
                $oferta->removeNorma($entity);
            };

            //hace falta desenganchar a todas las normas que referencian a la que voy a borrar
            $array_es_referenciada = $entity->getEsReferenciada();
            foreach ($array_es_referenciada as $es_referenciada) {
                $es_referenciada->removeReferenciaA($entity);
            }


            //borro la norma
            $this->getEm()->remove($entity);

            if ($flush) {
                $this->getEm()->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la norma exitosamente.');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $respuesta;
    }

    /**
     * Testeado
     * 
     * Elimina una referencia a una norma.
     * La referencia a una norma editada, es el lado inverso de la relación. 
     * Se deben tomar todas las normas que referencian a la editada, verificar cual es la que se desea eliminar 
     * y eliminar solo la referencia, no la norma.
     * 
     */
    public function eliminar_referencia(Norma $norma_apuntadora, Norma $norma_apuntada, Norma $norma_editada, Request $request) {
        $respuesta = new Respuesta();

        $referenciantes = $norma_apuntada->getEsReferenciada();
        
        try {
            foreach ($referenciantes as $referenciante){
                if ($referenciante->getNumero() === $norma_apuntadora->getNumero()){
                    $referenciante->removeReferenciaA($norma_apuntada);
                    $this->getEm()->persist($referenciante);
                }
            }
            
            $this->getEm()->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la referencia a la norma exitosamente.');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar la referencia. Verifique y reintente.');
        }
        return $respuesta;
    }

    public function getEm() {
        return $this->em;
    }

    /*
     * Testeado 
     * 
     * Dada la norma norma_editada, se selecciona una norma que o bien la referencia o bien es referenciada por.
     * Se genera la referencia que corresponda
     */

    public function referenciar(Norma $norma, Norma $norma_seleccionada, $accion) {

        $respuesta = new Respuesta();

        try {

            if ($accion == 'referencia_a') {
                $norma->addReferenciaA($norma_seleccionada);
                $this->getEm()->persist($norma);
            } else {
                $norma_seleccionada->addReferenciaA($norma);
                $this->getEm()->persist($norma_seleccionada);
            };
            $this->getEm()->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se referenció exitosamente.');
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al referenciar. Verifique y reintente.');
        };

        return $respuesta;
    }

}

