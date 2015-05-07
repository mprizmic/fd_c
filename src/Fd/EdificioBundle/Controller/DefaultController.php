<?php

namespace Fd\EdificioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

/**
 * @Route("/edificio")
 */
class DefaultController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepo() {
        return $this->getEm()->getRepository('EdificioBundle:Edificio');
    }

    /**
     * @Route("/nomina", name="edificio_nomina")
     */
    public function nominaAction() {
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        $edificios = $paginador->paginate(
                        $this->getDoctrine()->getEntityManager()->getRepository('EdificioBundle:Edificio')->qyAllOrdenado())
                ->getResult();

        return $this->render('EdificioBundle:Default:nomina.html.twig', array(
                    'edificios' => $edificios,
                ));
    }

    /**
     * Listado de sedes de los establecimiento detallando con quien comparten edificio
     *
     * @Route("/compartido", name="edificio_compartido")
     */
    public function compartidoAction() {

        $establecimientos = $this->getEm()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->findAllOrdenado('orden');
        return $this->render('EdificioBundle:Default:compartido.html.twig', array(
                    'establecimientos' => $establecimientos,
                ))
        ;
    }

    /**
     * @Route("/edificio_de_un_cue/{establecimiento_id}", name="edificio_de_un_cue")
     */
    public function de_un_cueAction($establecimiento_id) {
        $edificios = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('EdificioBundle:Edificio')
                ->findDeUnCue($establecimiento_id);

        return $this->render('EdificioBundle:Default:de_un_cue.html.twig', array(
                    'edificios' => $edificios,
                    'establecimiento_id' => $establecimiento_id,
                ));
    }

    /**
     * @Route("/tarjeta_edificio/{id}", name="tarjeta_edificio")
     * @Template("EdificioBundle:Default:tarjeta_edificio.html.twig")
     */
    public function tarjeta_edificioAction($edificio_id) {
        $edificio = $this->getDoctrine()->getRepository('EdificioBundle:Edificio')->find($edificio_id);

        return array('edificio' => $edificio);
    }

    /**
     * @Route("/ficha/{id}", name="edificio_ficha")
     * @Template("EdificioBundle:Default:ficha.html.twig")
     */
    public function fichaAction(Edificio $edificio) {
//       doctrine busca el $edificio que viene por parametro automaticamente
        return array('edificio' => $edificio,);
    }

}
