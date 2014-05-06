<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\BackendBundle\Form\DomicilioType;
use Fd\EdificioBundle\Event\FilterEdificioEvent;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Symfony\Component\HttpFoundation\Request;

/**
 * Domicilio controller.
 *
 * @Route("/domicilio")
 */
class DomicilioController extends Controller {

    /**
     * Lists all Domicilio entities.
     *
     * @Route("/", name="backend_domicilio")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EdificioBundle:Domicilio')->findBy(array(), array('calle' => 'ASC'));

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Domicilio entity.
     *
     * @Route("/{id}/show", name="backend_domicilio_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:Domicilio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Domicilio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Domicilio entity.
     * 
     * es un escucha del evento EdificioNuevo
     *
     * @Route("/new", name="backend_domicilio_new")
     * @Template()
     */
    public function newAction() {

        $entity = new Domicilio();
        $form = $this->createForm(new DomicilioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Domicilio entity.
     * No esta controlando el domicilio principal unico.
     * pasar esto al repo
     *
     * @Route("/create", name="backend_domicilio_create")
     * @Method("post")
     */
    public function createAction() {
        $entity = new Domicilio();
        $request = $this->getRequest();
        $form = $this->createForm(new DomicilioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $respuesta = $em->getRepository('EdificioBundle:Domicilio')->crear($entity);
        } else {
            $respuesta->setCodigo(2);
            $respuesta->setMensaje('El formulario tiene problemas. Verifique y reintente');
        }

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());


        if ($respuesta->getCodigo() == 1) {
            return $this->redirect($this->generateUrl('backend_domicilio_edit', array(
                                'id' => $respuesta->getClaveNueva(),
                            )));
        } else {
            return $this->render('BackendBundle:Domicilio:new.html.twig', array(
                        'entity' => $entity,
                        'form' => $form->createView()
                    ));
        }
    }

    /**
     * Displays a form to edit an existing Domicilio entity.
     *
     * @Route("/{id}/edit", name="backend_domicilio_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:Domicilio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Domicilio entity.');
        }

        $editForm = $this->createForm(new DomicilioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Domicilio entity.
     *
     * @Route("/{id}/update", name="backend_domicilio_update")
     * @Method("post")
     * 
     */
    public function updateAction($id, Request $request) {
        $respuesta = new Respuesta();

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('EdificioBundle:Domicilio');

        $entity = $repository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Domicilio entity.');
        }

        $editForm = $this->createForm(new DomicilioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $respuesta = $repository->actualizar($entity);
        } else {
            $respuesta->setMensaje('La información cargada es incorrecta. Verifique y reintente');
        }

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->render("BackendBundle:Domicilio:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
//        return array(
//            'entity' => $entity,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        );
    }

    /**
     * Deletes a Domicilio entity.
     *
     * @Route("/{id}/delete", name="backend_domicilio_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EdificioBundle:Domicilio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Domicilio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_domicilio'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
