<?php

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\TablaBundle\Entity\Nivel;

class CarreraManager {

    protected $em;
    protected $respuesta;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
    }

    /**
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar(Carrera $entity, Carrera $anterior, $originalOrientaciones = null, $originalTitulos = null) {
        $respuesta = new Respuesta();

        try {
            // filter $originalTags to contain tags no longer present
            foreach ($entity->getOrientaciones() as $orientacion) {
                foreach ($originalOrientaciones as $key => $toDel) {
                    if ($toDel->getId() === $orientacion->getId()) {
                        unset($originalOrientaciones[$key]);
                    }
                }
            }

            // remove the relationship between the tag and the Task
            foreach ($originalOrientaciones as $orientacion) {
                // remove the Task from the Tag
                //$orientacion->setCarrera(null);
                // if it were a ManyToOne relationship, remove the relationship like this
                //$em->persist($orientacion);
                // if you wanted to delete the Tag entirely, you can also do that
                $this->em->remove($orientacion);
            }

            // filter $originalTags to contain tags no longer present
            foreach ($entity->getTitulos() as $titulo) {
                foreach ($originalTitulos as $key => $toDel) {
                    if ($toDel->getId() === $titulo->getId()) {
                        unset($originalTitulos[$key]);
                    }
                }
            }
            // remove the relationship between the tag and the Task
            foreach ($originalTitulos as $titulo) {
                // remove the Task from the Tag
                //$orientacion->setCarrera(null);
                // if it were a ManyToOne relationship, remove the relationship like this
                //$em->persist($orientacion);
                // if you wanted to delete the Tag entirely, you can also do that
                $this->em->remove($titulo);
            }

            $this->em->persist($entity);

            $this->em->flush();

            $respuesta->setClaveNueva($entity->getId());

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó la carrera exitosamente');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar la nueva carrera. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    /**
     * Desde una carrera se asignan y desasignan establecimientos en los que se imparte la misma
     * @param type $carrera
     * @param type $establecimiento
     */
    public function asignarEstablecimiento($carrera_id, $establecimiento_id, $accion) {
        /**
         * Para cada establecimiento, si esta seleccionado se debe crear el registro de la tabla unidad_oferta (en caso de no preexistir).
         * Si no está seleccionado, se debe borrar el registro de dicha tabla (en caso de preexistir)
         */
        $carrera = $this->em->getRepository('OfertaEducativaBundle:Carrera')->find($carrera_id);
        if (!$carrera) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        };
        
        $establecimiento = $this->em->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);
        if (!$establecimiento) {
            throw $this->createNotFoundException('Unable to find Establecimiento entity.');
        };

        $respuesta = new Respuesta();

        //repositorio donde se crea la unidad_oferta
        $repo_uo = $this->em->getRepository('EstablecimientoBundle:UnidadOferta');

        if ($accion == 'Asignar') {

            //se verifica si ya existe la unidad_oferta
            $unidad_educativa = $establecimiento->getTerciario();
            $oferta_educativa = $carrera->getOferta();

            $unidad_oferta = $repo_uo->findOneBy(
                    array(
                        'unidades' => $unidad_educativa->getId(),
                        'ofertas' => $oferta_educativa->getId(),
                    ));

            if (!$unidad_oferta) {
                $handler = new UnidadOfertaHandler($this->em, $unidad_educativa->getNivel());

                $respuesta = $handler->crear($unidad_educativa, $oferta_educativa);
            }
        };
        if ($accion == 'Desasignar') {

            $unidad_educativa = $establecimiento->getTerciario();
            $oferta_educativa = $carrera->getOferta();

            $unidad_oferta = $repo_uo->findOneBy(
                    array(
                        'unidades' => $unidad_educativa->getId(),
                        'ofertas' => $oferta_educativa->getId(),
                    ));

            if ($unidad_oferta) {
                //existe y hay que darlo de baja
                //
                //creo el handler para la unidad_oferta
                $handler = new UnidadOfertaHandler($this->em, $unidad_educativa->getNivel());
                $respuesta = $handler->eliminar($unidad_oferta);
            }
        };

        return $respuesta;
    }

    /**
     * crear una carrera implica crear el regitro de ofertaeducativa correspondiente
     * 
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $entity
     * @return type
     */
    public function crear(Carrera $entity) {

        try {
            //busco entidad NIVEL
            //devuelve un array de una posicion
            $nivel = $this->em->getRepository('TablaBundle:Nivel')->findByAbreviatura('Ter');

            //se genera la oferta educativa
            $oferta = new OfertaEducativa();
            $oferta->setNivel($nivel[0]);
            $this->em->persist($oferta);

            //se genera la carrera
            $entity->setOferta($oferta);
            $this->em->persist($entity);
            $this->em->flush();

            $this->respuesta->setCodigo(1);
            $this->respuesta->setMensaje('La carrera se creó correctamente');
            $this->respuesta->setClaveNueva($entity->getId());
        } catch (Exception $e) {

            $this->respuesta->setCodigo(2);
            $this->respuesta->setMensaje('Problemas en la creación de la carrera');

            return $this->respuesta;
        };

        return $this->respuesta;
    }

    /**
     * desvincular una norma a una carrera 
     * 
     * FALTA tal vez debería ir en un manager de OfertEducativa
     */
    public function desvincular_norma($carrera, $norma) {
        $respuesta = new Respuesta();
        try {
            $oferta_educativa = $carrera->getOferta();
            $oferta_educativa->removeNorma($norma);
            
            $this->getEm()->persist($oferta_educativa);
            $this->getEm()->flush();
                    
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se desvinculó la norma exitosamente');
            
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al tratar de desvincular la norma. Verifique y reintente.');
        };
        return $respuesta;
        
    }
    /**
     * vincular una norma a una carrera 
     * 
     * FALTA tal vez debería ir en un manager de OfertEducativa
     */
    public function vincular_norma($carrera, $norma) {
        $respuesta = new Respuesta();
        try {
            $oferta_educativa = $carrera->getOferta();
            $oferta_educativa->vincularNorma($norma);
            
            $this->getEm()->persist($oferta_educativa);
            $this->getEm()->flush();
                    
            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se vinculó la norma exitosamente');
            
        } catch (Exception $e) {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al tratar de vincular la norma. Verifique y reintente.');
        };
        return $respuesta;
        
    }
    /**
     * Se elimina una carrera y la oferta educativa que le corresponde y la unidad_oferta que le corresponde
     * 
     * FALTA testear si se elimina la oferta educativa correspondiente
     * FALTA testear si se eliminan las orientaciones
     * FALTA borrar unidad_oferta
     * 
     * @param type $flush
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function eliminar(Carrera $carrera, $flush = false) {
        $respuesta = new Respuesta();
        try {
            //capturo la oferta que hay que eliminar. Estoy borrando desde el lado propietario de la relacion
            $oferta_educativa = $carrera->getOferta();
            
            //se elimina la unidad_oferta y todas sus asociaciones (turnos y cohortes)
            foreach ($oferta_educativa->getUnidades() as $unidad_oferta ) {
                $this->em->remove($unidad_oferta);
            }
            
            //elimino la oferta
            //por ser carrera el lado propietario debería eliminar oferta_educativa sin programar nada pero eso no pasa
            $this->em->remove($oferta_educativa);
            
            //elimino la carrera
            $this->em->remove($carrera);
            
            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la carrera exitosamente.');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('Problemas al eliminar. Verifique y reintente.');
        }

        return $respuesta;
    }

    /**
     * A partir de una collection de objetos carrera genera un array con el formato para pasar a json
     * 
     */
    public function generar_combo_json($entities) {

        $carreras = array();

        foreach ($entities as $entity) {
            $carrera['value'] = $entity->getId();
            $carrera['text'] = $entity->getNombre();
            $carreras[] = $carrera;
        };

        return $carreras;
    }

    public function getEm() {
        return $this->em;
    }

}

