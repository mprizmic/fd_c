<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
        $orientaciones = $this->getRepository()->findAll();

        return $this->render('OfertaEducativaBundle:MediaOrientaciones:nomina.html.twig', array(
                    'orientaciones' => $orientaciones,
        ));
    }

}
