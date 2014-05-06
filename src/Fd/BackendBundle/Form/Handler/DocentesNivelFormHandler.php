<?php

namespace Fd\BackendBundle\Form\Handler;

use Symfony\Component\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\DocentesNivelManager;

class DocentesNivelFormHandler {

    protected $em;
    protected $docentes_nivel_manager;

    public function __construct(DocentesNivelManager $docentes_nivel_manager) {
        $this->docentes_nivel_manager = $docentes_nivel_manager;
        $this->em = $this->docentes_nivel_manager->getEm();
    }

    /**
     * FALTA testear
     * 
     * @Method("POST")
     */
    public function actualizar(FormInterface $form, Request $request) {

        $respuesta = new Respuesta(); //la genera para el caso negativo

        $form->bind($request);

        if ($form->isValid()) {
            $respuesta = $this->docentes_nivel_manager->actualizar($form->getData());
        }
        return $respuesta;
    }

}