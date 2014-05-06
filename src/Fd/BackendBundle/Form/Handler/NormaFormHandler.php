<?php

namespace Fd\BackendBundle\Form\Handler;

use Symfony\Component\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Norma;
use Fd\OfertaEducativaBundle\Model\NormaManager;

class NormaFormHandler {

    protected $em;
    protected $norma_manager;

    public function __construct(NormaManager $norma_manager) {
        $this->norma_manager = $norma_manager;
        $this->em = $this->norma_manager->getEm();
    }

    /**
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function crear(FormInterface $form, Request $request) {

        $respuesta = new Respuesta(2, 'Problemas en la creación de la norma'); //carga error por default

        if (!$request->isMethod('POST')) {
            return $respuesta;
        }

        $form->bind($request);

        if ($form->isValid()) {

            $norma_valida = $form->getData();

            $respuesta = $this->norma_manager->crear($norma_valida);
        };

        return $respuesta;
    }

    /**
     * FALTA testear
     * 
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $anterior
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function eliminar(FormInterface $form, Request $request, Norma $entity) {
        $respuesta = new Respuesta(2, 'Problemas al eliminar la norma');

        if (!$request->isMethod('POST')) {
            return $respuesta;
        }

        $form->bind($request);

        if ($form->isValid()) {

            $respuesta = $this->norma_manager->eliminar($entity, true);
        };

        return $respuesta;
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
            $respuesta = $this->norma_manager->actualizar($form->getData(), true);
        }
        return $respuesta;
    }

}