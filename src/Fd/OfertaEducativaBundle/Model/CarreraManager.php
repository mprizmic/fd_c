<?php
/**
 * servicio ofertaeducativa.carrera.manager
 */

namespace Fd\OfertaEducativaBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\EstablecimientoBundle\Model\UnidadOfertaTerciarioHandler;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Model\OfertaEducativaManager;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadoInterface;
use Fd\OfertaEducativaBundle\Model\AsignarVisitador;
use Fd\OfertaEducativaBundle\Model\AsignarVisitadorInterface;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Model\NivelManager;


class CarreraManager implements AsignarVisitadoInterface {

    protected $em;
    protected $respuesta;
    protected $repository;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
        $this->repository = $em->getRepository('OfertaEducativaBundle:Carrera');
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
     * El visitador es para asignar la carrera a un establecimiento
     * 
     * @param AsignarVisitadorInterface $visitador
     * @return type
     */
    public function accept(AsignarVisitadorInterface $visitador) {
        return $visitador->visitCarrera($this);
    }

//    /**
//     * Desde una carrera se asignan y desasignan establecimientos en los que se imparte la misma
//     * @param type $carrera
//     * @param type $establecimiento
//     */
    public function asignarEstablecimiento($carrera_id, $establecimiento_id, $accion) {

        $carrera = $this->getRepository()->find($carrera_id);
        if (!$carrera) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        };

        $establecimiento = $this->em->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);
        if (!$establecimiento) {
            throw $this->createNotFoundException('Unable to find Establecimiento entity.');
        };

        $data['carrera'] = $carrera;
        $data['establecimiento'] = $establecimiento;
        $data['accion'] = $accion;

        //construye el visitador que va a asignar la carrera al establecimeinto
        $visitador = new AsignarVisitador($data);

        //ejecuta el metodo del visitador
        $respuesta = $this->accept($visitador);

        return $respuesta;
    }

    /**
     * crear una carrera implica crear el regitro de ofertaeducativa correspondiente
     * 
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $entity
     * @return type
     */
    public function crear(Carrera $entity, $flush = true) {

        try {
            //busco entidad NIVEL
            //devuelve un array de una posicion
            $nivel_manager = new NivelManager($this->getEm());
            $nivel = $nivel_manager->crearLleno('Ter');

            //se genera la oferta educativa
//            $oferta = new OfertaEducativa();
//            $oferta->setNivel($nivel);
//            $this->em->persist($oferta);
            $oe_manager = new OfertaEducativaManager($this->getEm());
            $oferta = $oe_manager->crearLlena($nivel);

            //se genera la carrera
            $entity->setOferta($oferta);
            $this->em->persist($entity);
            if ($flush) {
                $this->em->flush();
            };

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
     * Crea un nuevo objeto vacío
     * 
     * @return Carrera
     */
    public function crearNuevo(){
        return new Carrera();
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
            $unidad_oferta_manager = new UnidadOfertaHandler($this->getEm(), $oferta_educativa->getNivel());

            foreach ($oferta_educativa->getUnidades() as $unidad_oferta) {
                //se elimina desde el manager
                $respuesta = $unidad_oferta_manager->eliminar($unidad_oferta, false);
                if ($respuesta->getCodigo() !== 1) {
                    throw new Exception;
                };
            };

            //elimino la oferta educativa
            //por ser carrera el lado propietario debería eliminar oferta_educativa sin programar nada pero eso no pasa
            $oferta_educativa_manager = new OfertaEducativaManager($this->getEm());
            $respuesta = $oferta_educativa_manager->eliminar($oferta_educativa, false);
            if ($respuesta->getCodigo() !== 1) {
                throw new Exception;
            };

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
    public function getRepository(){
        return $this->repository;
    }

}
