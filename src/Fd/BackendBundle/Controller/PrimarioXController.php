<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\OfertaEducativaBundle\Entity\PrimarioX;
use Fd\BackendBundle\Form\PrimarioXType;

/**
 * PrimarioX controller.
 *
 * @Route("/primario_x")
 */
class PrimarioXController extends Controller
{
    /**
     * Lists all PrimarioX entities.
     *
     * @Route("/", name="primario_x")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OfertaEducativaBundle:PrimarioX')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a PrimarioX entity.
     *
     * @Route("/{id}/show", name="primario_x_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfertaEducativaBundle:PrimarioX')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrimarioX entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new PrimarioX entity.
     *
     * @Route("/new", name="primario_x_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PrimarioX();
        $form   = $this->createForm(new PrimarioXType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new PrimarioX entity.
     *
     * @Route("/create", name="primario_x_create")
     * @Method("POST")
     * @Template("BackendBundle:PrimarioX:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PrimarioX();
        $form = $this->createForm(new PrimarioXType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('primario_x_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PrimarioX entity.
     *
     * @Route("/{id}/edit", name="primario_x_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfertaEducativaBundle:PrimarioX')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrimarioX entity.');
        }

        $editForm = $this->createForm(new PrimarioXType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PrimarioX entity.
     *
     * @Route("/{id}/update", name="primario_x_update")
     * @Method("POST")
     * @Template("OfertaEducativaBundle:PrimarioX:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfertaEducativaBundle:PrimarioX')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PrimarioX entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PrimarioXType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('primario_x_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PrimarioX entity.
     *
     * @Route("/{id}/delete", name="primario_x_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OfertaEducativaBundle:PrimarioX')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PrimarioX entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('primario_x'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
