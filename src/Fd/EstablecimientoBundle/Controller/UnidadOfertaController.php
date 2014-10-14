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
use Symfony\Component\HttpFoundation\Request;
use Fd\EstablecimientoBundle\Form\Type\UnidadOfertaType;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;

/**
 * @Route("/unidadoferta")
 */
class UnidadOfertaController extends Controller {

    /**
     * @Route("/asignar_turno/{id}", name="establecimiento.unidad_oferta.asignar_turno")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta")
     */
    public function asignarTurnoAction($unidad_oferta) {

        $form = $this->createForm(new UnidadOfertaType(), $unidad_oferta);

        return $this->render('EstablecimientoBundle:UnidadOferta:turnos.html.twig', array(
                    'entity' => $unidad_oferta,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/actualizar_turnos/{id}", name="establecimiento.unidad_oferta.actualizar_turnos")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta")
     */
    public function actualizarTurnosAction(Request $request, $unidad_oferta) {

        $editForm = $this->createForm(new UnidadOfertaType(), $unidad_oferta);
        
        //guardo los turnos originales antes de bindear el request
        $originalTurnos = array();

        foreach ($unidad_oferta->getTurnos() as $turno) {
            $originalTurnos[] = $turno;
        }

        $editForm->bind($request);

        if ($editForm->isValid()) {

            $manager = new UnidadOfertaHandler($this->getDoctrine()->getEntityManager(), $unidad_oferta->getUnidades()->getNivel());

            $respuesta = $manager->actualizar($unidad_oferta, $originalTurnos);

            $mensaje = $respuesta->getMensaje();
        } else {

            $mensaje = 'Problemas al actualizar. Verifique y reintente';
        };

        $this->get('session')->getFlashBag()->add('error', $mensaje);
        
        //recupero la ruta a la cual hay que volver
        $ruta = $this->get('session')->get('ruta_completa');
        $params = $this->get('session')->get('parametros');
        
//        return $this->redirect($this->get('session')->get('ruta_completa'));
        return $this->redirect($this->generateUrl($ruta, $params ) );
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
