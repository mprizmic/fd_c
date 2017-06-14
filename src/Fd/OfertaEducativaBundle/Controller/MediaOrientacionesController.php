<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\EventListener\DownloadListener;
//use Fd\EstablecimientoBundle\Model\PlanillaSedesYAnexos;
//use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;
use Fd\OfertaEducativaBundle\Entity\MediaOrientaciones;

/**
 * @Route("/mediaorientaciones")
 */
class MediaOrientacionesController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:MediaOrientaciones');
    }

    /**
     * @Route("/nomina", name="oferta_educativa.media_orientaciones.nomina")
     */
    public function nominaAction() {

        $orientaciones = $this->getRepository()->findBy(array(), array('nombre' => 'asc'));

        return $this->render('OfertaEducativaBundle:MediaOrientaciones:nomina.html.twig', array(
                    'orientaciones' => $orientaciones,
        ));
    }

    /**
     * @Route("/por_establecimiento", name="oferta_educativa.media_orientaciones.por_establecimiento")
     * 
     */
    public function por_establecimiento() {

        $salida = array();
        $establecimientos = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->findAllOrdenado('orden');

        foreach ($establecimientos as $establecimiento) {

            $repository = $this->getEm()
                    ->getRepository('EstablecimientoBundle:EstablecimientoEdificio');

            $e_edificios = $repository->findSedeYAnexo($establecimiento);

            foreach ($e_edificios as $establecimiento_edificio) {

                $orientaciones = $repository->findMediaOrientaciones($establecimiento_edificio);

                if (count($orientaciones) > 0) {

                    $clave = $establecimiento_edificio->getEdificios()->getDomicilioPrincipal()->__toString();
                    $salida[$establecimiento->getApodo()][$clave]['orientaciones'] = $orientaciones;
                }
            }
        };
        return $this->render('OfertaEducativaBundle:MediaOrientaciones:por_establecimiento.html.twig', array(
                    'salida' => $salida,
        ));
    }

}
