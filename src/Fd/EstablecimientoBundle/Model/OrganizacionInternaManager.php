<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Repository\OrganizacionInternaRepository;
use Fd\TablaBundle\Entity\Dependencia;

class OrganizacionInternaManager {

    private $em;
    private $repository;
    private $crear_strategy;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->repository = $this->em->getRepository('EstablecimientoBundle:OrganizacionInterna');
    }

    public function getEm() {
        return $this->em;
    }

    public function getRepository() {
        return $this->repository;
    }

    /**
     * Para cada caso de creación distinto, se crea al objeto estrategia y se le pasan los parametros que correspondan
     * Siempre devuelve un objeto Respuesta
     * 
     * @param OrganizacionInterna $options
     * @return type
     */
    public function crear($options = array()) {

        $respuesta = new Respuesta();

        //se persiste un objeto ya sea nuevo lleno o existente
        if (isset($options['objeto'])) {

            $this->crear_strategy = new Strategies\CrearGuardarOrganizacionStrategy();

            $this->crear_strategy->setOrganizacion($options['objeto']);

            if (isset($options['flush'])) {
                $this->crear_strategy->setFlush($options['flush']);
            }

            $this->crear_strategy->setEm($this->getEm());

            return $this->crear_strategy->crear();
        };

        //se crea un objeto nuevo lleno
        if (isset($options['establecimiento_edificio_id']) and isset($options['dependencia_id'])) {

            $this->crear_strategy = new Strategies\CrearLlenoOrganizacionStrategy();

            $this->crear_strategy->setEstablecimiento($options['establecimiento_edificio_id']);
            $this->crear_strategy->setDependencia($options['dependencia_id']);
            $this->crear_strategy->setEm($this->getEm());

            return $this->crear_strategy->crear();
        };

        //se crea un objeto vacio
        if (count($options) == 0) {

            $this->crear_strategy = new Strategies\CrearVacioOrganizacionStrategy();

            return $this->crear_strategy->crear();
        }
    }

    public function eliminar($entity, $flush = true) {

        $respuesta = new Respuesta();

        try {

            $this->em->remove($entity);

            if ($flush) {
                $this->em->flush();
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se eliminó la dependencia exitosamente.');
        } finally {

            return $respuesta;
        }
    }

    /**
     * vertifica si existe la relacion establecimeinto - dependencia 
     * si existe devuelve el objeto. Si no existe devuelve null
     */
    public function existe($establecimiento_edificio, $dependencia) {

        return $this->repository->findOneBy(array(
                    'establecimiento' => $establecimiento_edificio,
                    'dependencia' => $dependencia,
        ));
    }

}
