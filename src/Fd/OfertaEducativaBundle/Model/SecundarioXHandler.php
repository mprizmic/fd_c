<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Entity\SecundarioX;
use Fd\EstablecimientoBundle\Entity\Respuesta;


class SecundarioXHandler {

    protected $em;

    public function __construct(EntityManager $em) {
        if (!$this->em){
            $this->em = $em;
        }
    }
    public function crearObjeto(){
        return new SecundarioX();
    }

    public function crear(UnidadOferta $unidad_oferta, $flush = false) {
        $secundario_x = $this->crearObjeto();

        if ($unidad_oferta) {
            $secundario_x->setUnidadOferta($unidad_oferta);
        }else{
            throwException($e);
        };

        $this->em->persist($secundario_x);
        
        if ($flush) {
            $this->em->flush();
        };
        return $secundario_x;
    }
//    public function eliminar($inicial_x, $flush = false){
//        $respuesta = new Respuesta();
//        try {
//            /*
//             * primero se elimina las salas de inicial_x. Luego se elimina inicial_x y luego unidad_oferta
//             */
//            $salas = $inicial_x->getSalas();
//            //borro cada sala
//            foreach ($salas as $sala) {
//                $inicial_x->removeSala($sala);
//                $this->em->remove($sala);
//            };
//            $this->em->remove($inicial_x);
//
//            if ($flush){
//                $this->em->flush();
//            };
//
//            $respuesta->setCodigo(1);
//            $respuesta->setMensaje('Se eliminaron las salas de la unidad educativa exitosamente.');
//        
//        } catch (Exception $e) {
//
//            $respuesta->setCodigo(2);
//            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
//        }
//
//        return $respuesta;
//    }
    /*
     * Para actualizar secundario_x hay que actualizar las orientaciones que vienen del form como una collection.
     * Para eso hace falta tener el estado anterior: como estaban las orientaciones en el response anterior.
     */
    public function actualizar($secundario_x, $orientaciones_anteriores = null ) {
        $respuesta = new Respuesta();

        try {
            //recupero las orientaciones que estàn originalmente guardadas en la BD
            $originalOrientaciones = array();
            foreach ($orientaciones_anteriores as $orientacion) {
                $originalOrientaciones[] = $orientacion;
            };

            // filter $originalTags to contain tags no longer present
            foreach ($secunario_x->getOrientaciones() as $orientaciones) {
                foreach ($originalOrientaciones as $key => $toDel) {
                    if ($toDel->getId() === $sala->getId()) {
                        unset($originalOrientaciones[$key]);
                    }
                }
            }

            // remove the relationship between the tag and the Task
            foreach ($originalOrientaciones as $orientacion) {
                $this->em->remove($orientacion);
            }

            $this->em->persist($secunario_x);
            $this->em->flush();

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó exitosamente');
            
        } catch (Exception $e) {
            
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar. Verifique los datos y reintente');
        }

        return $respuesta;
    }
}
