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
     * @Route("/new", name="backend.inicialx.new")
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
     * Creates a new orientacion entity a partir de un unidad_oferta_id.
     *
     * @Route("/crear/{unidad_oferta_id}", name="backend.inicialx.crear")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta", options={"id":"unidad_oferta_id"})
     */
    public function crearAction(Request $request, $unidad_oferta) {
        $entity = $this->getHandler()->crear($unidad_oferta);
        return $this->redirect($this->generateUrl('backend.inicialx.edit', array('id' => $entity->getId())));
    }

    /**
     * Muestra las salas de inicial de una unidad educativa.
     *
     * @Route("/{id}/edit", name="backend.inicialx.edit")
     * @ParamConverter("entity", class="OfertaEducativaBundle:InicialX")
     */
    public function editAction(InicialX $entity) {

        //recupero las salas existentes para la unidad educativa
//        $inicial_x = $this->getEm()->getRepository('OfertaEducativaBundle:InicialX')->findSalas($unidad_educativa->getOfertas()[0]);

        $editForm = $this->createForm(new InicialXType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render("BackendBundle:InicialX:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                        )
        );
    }

    /**
     * @Route("/{id}/{unidad_educativa_id}/update", name="backend_inicial_x_update")
     * @ParamConverter("entity", class="OfertaEducativaBundle:InicialX")
     * @Template("BackendBundle:InicialX:edit.html.twig")
     * @Method("post")
     */
    public function updateAction(InicialX $entity, Request $request) {

        $editForm = $this->createForm(new InicialXType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        $salas_anteriores = array();

        foreach ($entity->getSalas() as $sala) {
            $salas_anteriores[] = $sala;
        }

        $editForm->bind($request);

        if ($editForm->isValid()) {

            $respuesta = $this->getHandler()->actualizar($entity, $salas_anteriores);

            $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('backend.inicialx.edit', array('id' => $entity->getId())));
        };

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
