<?php

/**
 * unidad_oferta representa en que lugar esa ubicada la unidad educativa de que establecimiento 
 * en la que se imparte una oferta educativa en particular
 */

namespace Fd\EstablecimientoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Form\Type\UnidadOfertaType;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\EstablecimientoBundle\Utilities\Destino;
use Fd\EstablecimientoBundle\Entity\Respuesta;

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
                    'unidad_oferta' => $unidad_oferta,
                    'form' => $form->createView(),
        ));
    }

    /**
     * esto genera mal el handler/manager. hay que revisarlo
     * 
     * Esta duplicando la funcion que esta en el controller del backend
     * 
     * @Route("/actualizar_turnos/{id}", name="establecimiento.unidad_oferta.actualizar_turnos")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta")
     */
    public function actualizarTurnosAction(Request $request, $unidad_oferta) {
        
        $respuesta = new Respuesta();

        $editForm = $this->createForm(new UnidadOfertaType(), $unidad_oferta);

        //guardo los turnos originales antes de bindear el request
        $originalTurnos = array();

        foreach ($unidad_oferta->getTurnos() as $turno) {
            $originalTurnos[] = $turno;
        }

        $editForm->bind($request);

        if ($editForm->isValid()) {

            $manager = new UnidadOfertaHandler($this->getDoctrine()->getEntityManager());

            $respuesta = $manager->actualizar($unidad_oferta, $originalTurnos);

            $mensaje = $respuesta->getMensaje();
        } else {

            $mensaje = 'Problemas al actualizar. Verifique y reintente';
        };

        $tipo = ($respuesta->getCodigo() == 1 ) ? 'exito' : 'error';

        $this->get('session')->getFlashBag()->add($tipo, $mensaje);

        //redirecciona a una pagina que es la ultima que se guardo en la sesion para redireccionar
        //vuelve a una pagina predeterminada
        return $this->redirect(Destino::generateUrlDesdeSession($this->get('session'), $this->get('router')));
    }
    /**
     * @Route("/tarjeta/{id}", name="establecimiento.unidad_oferta.tarjeta")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta")
     * 
     * @param type $unidad_oferta
     */
    public function tarjetaAction($unidad_oferta){

        return $this->render('EstablecimientoBundle:UnidadOferta:tarjeta.html.twig', array(
                    'unidad_oferta' => $unidad_oferta,
        ));        
    }
}
