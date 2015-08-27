<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Entity\Sala;
use Fd\OfertaEducativaBundle\Model\SalaHandler;
use Fd\EstablecimientoBundle\Entity\Respuesta;


class InicialXHandler {

    protected $em;

    public function __construct(EntityManager $em) {
        if (!$this->em){
            $this->em = $em;
        }
    }
    public function crearObjeto() {
        return new InicialX();
    }    

    public function crear(UnidadOferta $unidad_oferta) {
        
        $inicial_x = $this->crearObjeto();
        
        try{
            $this->em->persist($inicial_x);
            $this->em->flush();
            
            $unidad_oferta->setInicial($inicial_x);
            $this->em->persist($unidad_oferta);
            
            $inicial_x->setUnidadOferta($unidad_oferta);
            $this->em->flush();
        } catch (Exception $ex) {
            throwException($e);
        };
        
        return $inicial_x;

    }

    public function eliminar($inicial_x, $flush = false){
        $respuesta = new Respuesta();
        try {
            /*
             * primero se elimina las salas de inicial_x. Luego se elimina inicial_x y luego unidad_oferta
             */
            $salas = $inicial_x->getSalas();
            //borro cada sala
            foreach ($salas as $sala) {
                $inicial_x->removeSala($sala);
                $this->em->remove($sala);
            };
            $this->em->remove($inicial_x);

            if ($flush){
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminaron las salas de la unidad educativa exitosamente.');
        
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $respuesta;
    }
    /*
     * Para actualizar incial_x hay que actualizar las salas que vienen del form como una collection.
     * Para eso hace falta tener el estado anterior de las salas: como estaban en el response anterior.
     */
    public function actualizar($inicial_x, $salas_anteriores) {
        $respuesta = new Respuesta();

        try {
            //recupero las orientaciones que estàn originalmente guardadas en la BD
            $originalSalas = array();
            foreach ($salas_anteriores as $sala) {
                $originalSalas[] = $sala;
            };

            // filter $originalTags to contain tags no longer present
            foreach ($inicial_x->getSalas() as $sala) {
                foreach ($originalSalas as $key => $toDel) {
                    if ($toDel->getId() === $sala->getId()) {
                        unset($originalSalas[$key]);
                    }
                }
            }

            // remove the relationship between the tag and the Task
            foreach ($originalSalas as $sala) {
                // remove the Task from the Tag
                // if it were a ManyToOne relationship, remove the relationship like this
                //$em->persist($orientacion);
                // if you wanted to delete the Tag entirely, you can also do that
                $this->em->remove($sala);
            }

            $this->em->persist($inicial_x);
            $this->em->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardaron las salas exitosamente');
            
        } catch (Exception $e) {
            
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar. Verifique los datos y reintente');
        }

        return $respuesta;
    }
}
