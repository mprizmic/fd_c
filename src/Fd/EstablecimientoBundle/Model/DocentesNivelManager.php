<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\BackendBundle\Form\Model\DocentesNivelHandler;

class DocentesNivelManager {

    protected $em;
    protected $respuesta;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
    }

    /**
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($formulario) {
        $respuesta = new Respuesta();

        try {
            //aca se guardan todos los niveles que correspondan

            $establecimiento = $formulario->getEstablecimiento();
            $unidades_educativas = $establecimiento->getUnidadesEducativas();

            foreach ($unidades_educativas as $unidad_educativa) {
                $unidad_educativa->setCantidadDocentes($formulario->getCantidad($unidad_educativa->getNivel()->getAbreviatura()));

                //se persiste en el repositorio de unidad educativa
                $this->getEm()->getRepository('EstablecimientoBundle:UnidadEducativa')->actualizar($unidad_educativa, null);
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

