<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\BackendBundle\Form\Model\DocentesNivelHandler;
use Fd\BackendBundle\Form\Handler\UnidadEducativaHandler;

class DocentesNivelManager {

    private $em;
    private $respuesta;
    private $unidad_educativa_handler;

    public function __construct(EntityManager $em, UnidadEducativaHandler $unidad_educativa_handler) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
        $this->unidad_educativa_handler = $unidad_educativa_handler;
    }

    /**
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($formulario) {
        $respuesta = $this->respuesta;

        try {
            //aca se guardan todos los niveles que correspondan

            $establecimiento = $formulario->getEstablecimiento();
            $unidades_educativas = $establecimiento->getUnidadesEducativas();

            foreach ($unidades_educativas as $unidad_educativa) {
                $unidad_educativa->setCantidadDocentes($formulario->getCantidad($unidad_educativa->getNivel()->getAbreviatura()));

                //se persiste en el repositorio de unidad educativa
                $this->unidad_educativa_handler->actualizar($unidad_educativa, true);
            };

            $respuesta->setCodigo(1);
            $respuesta->setMensaje('Se guardó exitosamente');
        } catch (Exception $e) {

            $respuesta->setCodigo(2);
            $respuesta->setMensaje('No se pudo guardar. Verifique los datos y reintente');
        }

        return $respuesta;
    }

    public function getEm() {
        return $this->em;
    }

}

