<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\BackendBundle\Entity\Portada;
use Fd\BackendBundle\Form\PortadaType;

/**
 * Portada controller.
 *
 * @Route("/tabla_portada")
 */
class PortadaController extends Controller
{
    /**
     * Lists all Portada entities.
     *
     * @Route("/", name="backend_portada")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Portada')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Portada entity.
     *
     * @Route("/{id}/show", name="backend_portada_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Portada')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Portada entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Portada entity.
     *
     * @Route("/new", name="backend_portada_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Portada();
        $form   = $this->createForm(new PortadaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Portada entity.
     *
     * @Route("/create", name="backend_portada_create")
     * @Method("POST")
     * @Template("BackendBundle:Portada:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Portada();
        $form = $this->createForm(new PortadaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_portada_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Portada entity.
     *
     * @Route("/{id}/edit", name="backend_portada_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Portada')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Portada entity.');
        }

        $editForm = $this->createForm(new PortadaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Portada entity.
     *
     * @Route("/{id}/update", name="backend_portada_update")
     * @Method("POST")
     * @Template("BackendBundle:Portada:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Portada')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Portada entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PortadaType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_portada_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Portada entity.
     *
     * @Route("/{id}/delete", name="backend_portada_delete")
     * @Method("POST")routing.yml
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendBundle:Portada')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Portada entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_portada'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
