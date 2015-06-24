<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Autoridad;

/**
 * Autoridad controller.
 *
 * @Route("/autoridad")
 */
class AutoridadController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepositorio() {
        return $this->getEm()->getRepository('EstablecimientoBundle:Autoridad');
    }

    /**
     * @Route("/listado_rectores", name="establecimiento.autoridad.listado_rectores")
     * @Template()
     */
    public function listado_rectoresAction() {
        $rectores = $this->getRepositorio()
                ->findRectores();

        return array(
            'rectores' => $rectores,
        );
    }

}
