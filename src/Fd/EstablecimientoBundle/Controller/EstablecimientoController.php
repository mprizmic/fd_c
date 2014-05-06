<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

/**
 * @Route("/establecimiento")
 */
class EstablecimientoController extends Controller {

    private $em;
    private $repositorio;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepositorio() {
        return $this->getEm()
                        ->getRepository('EstablecimientoBundle:Establecimiento');
    }

    /**
     * Listado de docentes por nivel de cada establecimiento
     *
     * @Route("/docentes_nivel_listado", name="establecimiento_docentes_nivel_listado")
     */
    public function docentesNivelListadoAction() {

        $establecimientos = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->findAllOrdenado('orden');

        return $this->render('EstablecimientoBundle:Default:docentes_nivel_listado.html.twig', array(
                    'establecimientos' => $establecimientos,
                ))
        ;
    }

    /**
     * @Route("/cuadro_matricula/{establecimiento_id}/{tipo}", name="establecimientos_cuadro_matricula")
     * @Template("EstablecimientoBundle:Default:cuadro_matricula.html.twig")
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento", options={"id"="establecimiento_id"})
     */
    public function cuadro_matriculaAction($establecimiento, $tipo) {

        $hoy = date("Y");
        $anio_desde = $hoy - 2;

        //todas las carreras de un establecimiento
        $carreras = $this->getRepositorio()
                ->findCarreras($establecimiento);

        foreach ($carreras as $key => $value) {
            $una_carrera['nombre'] = $value->getNombre();
            $una_carrera['id'] = $value->getId();
            $una_carrera['cohortes'] = array();
            for ($i = $anio_desde; $i <= $hoy; $i++) {

                $datos = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')
                        ->findMatriculaCarrera($i, $value->getId(), $establecimiento->getId());
                //el resultado vienen en un array con key de cero en adelante
                //en este caso el resultado siempre es un solo array 
                $una_carrera['cohortes'][$i]['ingresantes'] = $datos[0]['matricula_ingresantes'];
                $una_carrera['cohortes'][$i]['matricula'] = $datos[0]['matricula'];
                $una_carrera['cohortes'][$i]['egreso'] = $datos[0]['egreso'];
            }
            $salida[] = $una_carrera;
        }

        return array(
            'unidades_ofertas' => null,
            'establecimiento' => $establecimiento,
            'salida' => $salida,
            'anio_desde' => $anio_desde,
            'anio_hasta' => $hoy,
        );
    }

    /**
     * @Route("/damero", name="establecimiento_damero")
     */
    public function dameroAction() {
        $paginador = $this->get('ideup.simple_paginator');

//        establecimientos paginados
        $establecimientos = $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')
                        ->qyAllOrdenado('orden')->getResult();

        return $this->render('EstablecimientoBundle:Default:damero.html.twig', array(
                    'establecimientos' => $establecimientos,
                ));
    }

    /**
     * @Route("/establecimiento_de_un_cui/{edificio_id}", name="establecimiento_de_un_cui")
     */
    public function establecimiento_de_un_cuiAction($edificio_id) {
        $establecimientos = $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')->findDeUnCui($edificio_id);

        return $this->render('EstablecimientoBundle:Default:establecimiento_de_un_cui.html.twig', array(
                    'establecimientos' => $establecimientos,
                    'edificio_id' => $edificio_id,
                ));
    }

    /**
     * @Route("/index", name="establecimiento_index")
     * @Template()
     */
    public function indexAction() {
        return new Response('index de estbablecimientos');
    }

    /**
     * @Route("/ficha/{establecimiento_id}", name="establecimiento_ficha")
     * @Template("EstablecimientoBundle:Default:ficha.html.twig")
     */
    public function fichaAction($establecimiento_id) {
        $repo = $this->getDoctrine()->getRepository('EstablecimientoBundle:Establecimiento');
        $establecimiento = $repo->find($establecimiento_id);
        $establecimientos = $repo->qyAllOrdenado('orden')->getResult();
        $edificio_principal = $repo->findEdificioPrincipal($establecimiento);
        $carreras = $repo->findCarreras($establecimiento);
        $especializaciones = $repo->findEspecializaciones($establecimiento);
        $salas_inicial = $repo->findSalasInicial($establecimiento);
        $primario = $repo->findPrimario($establecimiento);

        return array(
            'establecimiento' => $establecimiento,
            'edificio_principal' => $edificio_principal,
            'carreras' => $carreras,
            'especializaciones' => $especializaciones,
            'salas_inicial' => $salas_inicial,
            'establecimientos' => $establecimientos,
            'primario' => $primario,
        );
    }

    /**
     * @Route("/nomina", name="establecimiento_nomina")
     */
    public function nominaAction() {
        $paginador = $this->get('ideup.simple_paginator');

        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

//        establecimientos paginados
        $establecimientos = $paginador->paginate(
                        $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')
                                ->qyAllOrdenado('orden')
                )->getResult();

        return $this->render('EstablecimientoBundle:Default:nomina.html.twig', array(
                    'establecimientos' => $establecimientos,
                ));
    }

    /**
     * devuelve el nro siguiente al del nro de anexo más alto existente para un establecimiento
     * Devuelve el dato en json.
     * @Route("/nuevo_anexo/{id}", name="establecimiento_nuevo_anexo")
     */
    public function nuevoNroAnexoAction($id, Request $resquest) {
        $establecimiento = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->find($id);

        if (!$establecimiento) {
            throw $this->createNotFoundException($message = "No existe el establecimiento");
        };

        //calculo el nuevo nro de anexo
        $nuevo = $establecimiento->getNroNuevoAnexo();

        $datos = array("responseCode" => 200, "respuesta" => $nuevo);
        $response = new Response();
        $response->setContent(json_encode($datos));
        $response->headers->set('content-type', 'application/json');
        return $response;
    }

    /**
     * @Route("/tarjeta_establecimiento/{establecimiento_id}", name="tarjeta_establecimiento")
     */
    public function tarjeta_establecimientoAction($establecimiento_id) {
        $establecimiento = $this->getDoctrine()->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);

        return $this->render('EstablecimientoBundle:Default:tarjeta_establecimiento.html.twig', array(
                    'establecimiento' => $establecimiento,
                ));
    }

}
