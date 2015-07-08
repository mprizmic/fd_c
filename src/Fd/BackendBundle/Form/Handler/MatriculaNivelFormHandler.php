<?php

namespace Fd\BackendBundle\Form\Handler;

use Symfony\Component\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\MatriculaNivelManager;

class MatriculaNivelFormHandler {

    protected $em;
    protected $matricula_nivel_manager;

    public function __construct(MatriculaNivelManager $matricula_nivel_manager) {
        $this->matricula_nivel_manager = $matricula_nivel_manager;
        $this->em = $this->matricula_nivel_manager->getEm();
    }

    /**
     * @Method("POST")
     */
    public function actualizar(FormInterface $form, Request $request) {

        $respuesta = new Respuesta(); //la genera para el caso negativo

        $form->bind($request);

        if ($form->isValid()) {
            $respuesta = $this->matricula_nivel_manager->actualizar($form->getData());
        }
        return $respuesta;
    }

}