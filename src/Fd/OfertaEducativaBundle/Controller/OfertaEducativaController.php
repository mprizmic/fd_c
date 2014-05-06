<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/oferta_educativa")
 */
class OfertaEducativaController extends Controller {

    /**
     * @Route("/nomina", name="oferta_educativa_nomina")
     * @Template("OfertaEducativaBundle:OfertaEducativa:nomina.html.twig")
     */
    public function nominaAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $oes = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->findAllOrdenadoPorNivel();
        return array('oes' => $oes,
        );
    }
}
