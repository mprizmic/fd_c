<?php

/**
 * unidad_oferta representa en que unidad educativa de que establecimiento se imparte una oferta educativa en particular
 */

namespace Fd\EstablecimientoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Fd\EstablecimientoBundle\Form\Type\UnidadOfertaType;

/**
 * @Route("/unidadoferta")
 */
class UnidadOfertaController extends Controller {

    /**
     * @Route("/asignar_turno/{id}", name="establecimiento.unidad_oferta.asignar_turno")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta")
     */
    public function asignarTurnoAction($unidad_oferta) {

//        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new UnidadOfertaType());

        return $this->render('EstablecimientoBundle:UnidadOferta:turnos.html.twig', array(
                    'entity' => $unidad_oferta,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/index",  name="establecimiento.unidad_oferta.index")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EstablecimientoBundle:UnidadOferta')->findAll();

        return array('entities' => $entities);
    }

}
