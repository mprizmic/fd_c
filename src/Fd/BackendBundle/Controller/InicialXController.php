<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Form\InicialXType;
use Fd\OfertaEducativaBundle\Model\InicialXHandler;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;

/**
 * @Route("/inicialx")
 */
class InicialXController extends Controller {

    private $em;
    private $handler;
    /**
     * devuelve el EntityManager
     */
    public function getEm() {
        if ($this->em == null) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }
    private function getHandler() {
        if (!$this->handler) {
            $this->handler = new InicialXHandler($this->getEm());
        };
        return $this->handler;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:SecundarioX');
    }
    /**
     * @Route("/new", name="backend.inicialx.crear")
     * @Template()
     */
    public function newAction() {
        $entity = $this->getHandler()->crearObjeto();
        $form = $this->createForm(new InicialXType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }    
    /**
     * Muestra las salas de inicial de una unidad educativa.
     *
     * @Route("/{inicial_x_id}/{unidad_educativa_id}/edit", name="backend_inicial_x_edit")
     * @ParamConverter("inicial_x", class="OfertaEducativaBundle:InicialX", options={"id" = "inicial_x_id"} )
     * @ParamConverter("unidad_educativa", class="EstablecimientoBundle:UnidadEducativa", options={"id" = "unidad_educativa_id"} )
     */
    public function editAction(InicialX $inicial_x, UnidadEducativa $unidad_educativa) {

        //recupero las salas existentes para la unidad educativa
//        $inicial_x = $this->getEm()->getRepository('OfertaEducativaBundle:InicialX')->findSalas($unidad_educativa->getOfertas()[0]);

        $editForm = $this->createForm(new InicialXType(), $inicial_x);

        return $this->render("BackendBundle:InicialX:edit.html.twig", array(
                    'entity' => $inicial_x,
                    'form' => $editForm->createView(),
                    'unidad_educativa' => $unidad_educativa,
                        )
        );
    }


    /**
     * @Route("/{inicial_x_id}/{unidad_educativa_id}/update", name="backend_inicial_x_update")
     * @ParamConverter("inicial_x", class="OfertaEducativaBundle:InicialX", options={"id" = "inicial_x_id"} )
     * @ParamConverter("unidad_educativa", class="EstablecimientoBundle:UnidadEducativa", options={"id" = "unidad_educativa_id"} )
     * @Method("post")
     */
    public function updateAction(InicialX $inicial_x, UnidadEducativa $unidad_educativa) {

        $respuesta = new Respuesta();
        
        $salas_anteriores = array();

        foreach ($inicial_x->getSalas() as $sala) {
            $salas_anteriores[] = $sala;
        }

        $editForm = $this->createForm(new InicialXType(), $inicial_x);

        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {

            $handler = new InicialXHandler($this->getEm());

            $respuesta = $handler->actualizar($inicial_x, $salas_anteriores);

            $session = $this->get('session')->
                    getFlashBag()->
                    add('exito', $respuesta->getMensaje())
            ;

            return $this->redirect($this->generateUrl('backend_inicial_x_edit', array(
                                'inicial_x_id' => $inicial_x->getId(),
                                'unidad_educativa_id' => $unidad_educativa->getId(),
                            ))
            );
        };

        //si no valida el formulario se vuelve a mostrar la misma pàgina de edit
        $session = $this->get('session')->
                getFlashBag()->
                add('error', $respuesta->getMensaje())
        ;

        return $this->render("BackendBundle:InicialX:edit.html.twig", array(
                    'entity' => $inicial_x,
                    'form' => $editForm->createView(),
                    'unidad_educativa' => $unidad_educativa,
                        )
        );
    }

}
