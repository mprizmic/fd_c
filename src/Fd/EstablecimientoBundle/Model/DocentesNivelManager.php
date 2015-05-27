<?php

namespace Fd\EstablecimientoBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormInterface;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEstablecimiento;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\LocalizacionManager;
use Fd\BackendBundle\Form\Model\DocentesNivelHandler;

class DocentesNivelManager {

    private $em;
    private $respuesta;
    private $unidad_educativa_handler;

    public function __construct(EntityManager $em, LocalizacionManager $localizacion_manager) {
        $this->em = $em;
        $this->respuesta = new Respuesta();
        $this->localizacion_manager = $localizacion_manager;
    }

    /**
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function actualizar($formulario) {
        $respuesta = $this->respuesta;

        try {
            //aca se guardan todos los niveles que correspondan

            $establecimiento_edificio = $formulario->getEstablecimientoEdificio();
            $localizaciones = $establecimiento_edificio->getLocalizacion();

            foreach ($localizaciones as $localizacion) {
                $localizacion->setCantidadDocentes($formulario->getCantidad($localizacion->getUnidadEducativa()->getNivel()->getAbreviatura()));

                //se persiste en el repositorio de unidad educativa
                $this->localizacion_manager->actualizar($localizacion, true);
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

