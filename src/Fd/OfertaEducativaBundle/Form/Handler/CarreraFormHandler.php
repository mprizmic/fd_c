<?php

namespace Fd\OfertaEducativaBundle\Form\Handler;

use Symfony\Component\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Model\CarreraManager;

class CarreraFormHandler {

    protected $em;
    protected $carrera_manager;

    public function __construct(CarreraManager $carrera_manager) {
        $this->carrera_manager = $carrera_manager;
        $this->em = $this->carrera_manager->getEm();
    }

    /**
     * @param \Fd\OfertaEducativaBundle\Form\Handler\FormInterface $form
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function crear(FormInterface $form, Request $request) {

        $respuesta = new Respuesta(2,'Problemas en la creación de la carrera' ); //carga error por default
        
        if (!$request->isMethod('POST')) {
            return $respuesta;
        }
        
        $form->bind($request);
        
        if ($form->isValid()) {

            $carrera_valida = $form->getData();

            $respuesta = $this->carrera_manager->crear($carrera_valida);
        };
        
        return $respuesta;
    }
    /**
     * 
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Fd\OfertaEducativaBundle\Entity\Carrera $anterior
     * @return \Fd\EstablecimientoBundle\Entity\Respuesta
     */
    public function eliminar(FormInterface $form, Request $request, Carrera $anterior) {
        $respuesta = new Respuesta(2, 'Problemas al eliminar una carrera');
        
        if (!$request->isMethod('POST')){
            return $respuesta;
        }
        
        $form->bind($request);
        
        if ($form->isValid()) {
            
            $respuesta = $this->carrera_manager->eliminar($anterior, true);
        };
        
        return $respuesta;
    }
    /**
     * @Method("POST")
     */
    public function actualizar(FormInterface $form, Request $request){

        $respuesta = new Respuesta(); //la genera para el caso negativo
        
        //si cambió de estado de validez, se guarda registro
        $anterior = clone $form->getData();
        
        //se guarda el array de orientaciones para realizar la actualización
        //se guarda aparte porque la entidad clonada, luego del bind pierde los datos anteriores por problemas de punteros de objetos
        //de la entidad, todo lo que sea referencias a otras tablas, si pierde luego del bind
        $orientaciones = array();
        foreach ($form->getData()->getOrientaciones() as $key => $value) {
            $orientaciones[] = $value;
        }
        //se guarda el array de orientaciones para realizar la actualización
        //se guarda aparte porque la entidad clonada, luego del bind pierde los datos anteriores por problemas de punteros de objetos
        //de la entidad, todo lo que sea referencias a otras tablas, si pierde luego del bind
        $titulos = array();
        foreach ($form->getData()->getTitulos() as $key => $value) {
            $titulos[] = $value;
        }

        $form->bind($request);
        
        if ($form->isValid()){
            $respuesta = $this->carrera_manager->actualizar($form->getData(), $anterior, $orientaciones, $titulos);
        }
        return $respuesta;
    }

}