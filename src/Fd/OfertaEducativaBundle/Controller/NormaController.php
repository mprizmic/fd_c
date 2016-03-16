<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\CallbackValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; //permite la annotation method
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\Constantes;
use Fd\BackendBundle\Form\NormaBuscarType;
use Fd\OfertaEducativaBundle\Entity\Norma;

/**
 * @Route("/norma")
 */
class NormaController extends Controller {

    private $em;

    public function getEm() {
        if (is_null($this->em)) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * @Route("/ver/{id}", name="norma_ver")
     * ParamConverter("norma", class="OfertaEducativaBundle:Norma")
     * 
     */
    public function normaAction(Norma $norma) {

        return $this->render('OfertaEducativaBundle:Norma:ver.html.twig', array(
                    'entity' => $norma,
                    'titulo' => 'Ver',
                ));
    }

    /**
     * Procesa la pagina de busqueda de norma que se usa para asignar una norma a una carrera
     * La grilla que muestra los resultados tiene una acción especial de asignacion a carrera
     * 
     * Esta acción es invocada desde la pantalla de ediciòn de una carrera
     * 
     * @Route("/norma_buscar_asignar_carrera/{carrera_id}", name="norma_buscar_asignar_carrera")
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={"id"="carrera_id"} )
     */
    public function buscarAsignarCarreraAction($carrera, Request $request) {

        if ($request->getMethod() == 'POST') {
            //se diparó la búsqueda desde el formulario

            $formulario = $this->createForm(new NormaBuscarType());
            $formulario->bind($request);

            if ($formulario->isValid()) {
                $datos = $formulario->getData();

                $this->get('session')->set('datos', $datos);

                $normas = $this->obtenerNormasPaginadas($datos);

                $carrera_id = $this->get('session')->get('carrera_id');
            } else {
                $normas = array();
                $carrera_id = null;
            }
        }
        if ($request->getMethod() == 'GET') {
            $formulario = $this->createForm(new NormaBuscarType());
            //o bien se pidió la página o bien se pidió la paginación de los resultados
            //la paginacion manda un GET con la variable 'page'. Si no existe 'page' no fue un request de paginacion
            if ($request->query->get('page')) {
                //se pidió paginación
                //asigno datos 
                $carrera_id = $this->get('session')->get('carrera_id');
                $datos = $this->get('session')->get('datos');
                $formulario->setData($datos);
                $normas = $this->obtenerNormasPaginadas($datos);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $normas = array();
//                $carrera_id = $request->query->get('carrera_id');
                $this->get('session')->set('carrera_id', $carrera->getId());
            }
        }

        $content = $this->renderView('OfertaEducativaBundle:Norma:buscar_asignar.html.twig', array(
            'formulario' => $formulario->createView(),
            'normas' => $normas,
            'carrera_id' => $carrera->getId(),
                ));

        return new Response($content);
    }

    public function obtenerNormasPaginadas($datos) {
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage(Constantes::GRILLA_MEDIANO);

        //hay por lo menos un campo con algo
        $normas = $paginador->paginate(
                        $this->getEm()->
                                getRepository('OfertaEducativaBundle:Norma')->
                                qyFiltradas($datos)
                )->getResult();
        return $normas;
    }

}