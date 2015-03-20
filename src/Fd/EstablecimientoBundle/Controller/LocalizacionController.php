<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\BackendBundle\Form\LocalizacionType;
use Fd\EdificioBundle\Form\Type\DomiciliosType;
use Fd\EdificioBundle\Form\Type\UnDomicilioType;

/**
 * Localizacion controller.
 *
 * @Route("/localizacion")
 */
class LocalizacionController extends Controller {

    private $em;

    /**
     * devuelve el EntityManager
     */
    public function getEm() {
        if ($this->em == null) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }
    /**
     * @Route("/cuadro_matricula/{localizacion_id}/{tipo}", name="sede_anexo_cuadro_matricula")
     * @Template("EstablecimientoBundle:Localizacion:cuadro_matricula.html.twig")
     * @ParamConverter("localizacion", class="EstablecimientoBundle:Localizacion", options={"id"="localizacion_id"})
     */
    public function cuadro_matriculaAction(Localizacion $localizacion, $tipo) {

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
}
