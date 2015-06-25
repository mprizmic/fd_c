<?php

namespace Fd\EdificioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Autoridad;

/**
 * Inspector controller.
 *
 * @Route("/inspector")
 */
class InspectorController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepositorio() {
        return $this->getEm()->getRepository('EdificioBundle:Inspector');
    }

    /**
     * @Route("/listado_inspectores", name="edificio.inspector.listado_inspectores")
     * @Template()
     */
    public function listado_inspectoresAction() {
        $edificio_establecimientos = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->qbInspectores()
                ->getQuery()
                ->getResult();

        return array(
            'establecimiento_edificios' => $edificio_establecimientos,
        );
    }

}
