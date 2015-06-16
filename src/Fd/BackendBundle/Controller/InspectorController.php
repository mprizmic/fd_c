<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EdificioBundle\Entity\Inspector;
use Fd\BackendBundle\Form\InspectorType;

/**
 * Inspector de infraestructura controller 
 * 
 * @Route("/inspector")
 */
class InspectorController extends Controller
{
    /**
     * Lists all Inspector entities.
     *
     * @Route("/", name="backend_inspector")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EdificioBundle:Inspector')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Inspector entity.
     *
     * @Route("/{id}/show", name="backend_inspector_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:Inspector')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inspector entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Inspector entity.
     *
     * @Route("/new", name="backend_inspector_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Inspector();
        $form   = $this->createForm(new InspectorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Inspector entity.
     *
     * @Route("/create", name="backend_inspector_create")
     * @Method("post")
     * @Template("EdificioBundle:Inspector:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Inspector();
        $request = $this->getRequest();
        $form    = $this->createForm(new InspectorType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_inspector_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Inspector entity.
     *
     * @Route("/{id}/edit", name="backend_inspector_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:Inspector')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inspector entity.');
        }

        $editForm = $this->createForm(new InspectorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Inspector entity.
     *
     * @Route("/{id}/update", name="backend_inspector_update")
     * @Method("post")
     * @Template("BackendBundle:Inspector:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:Inspector')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inspector entity.');
        }

        $editForm   = $this->createForm(new InspectorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_inspector_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Inspector entity.
     *
     * @Route("/{id}/delete", name="backend_inspector_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EdificioBundle:Inspector')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inspector entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_inspector'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
