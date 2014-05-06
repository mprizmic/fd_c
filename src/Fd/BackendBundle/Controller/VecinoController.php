<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EdificioBundle\Entity\Vecino;
use Fd\BackendBundle\Form\VecinoType;

/**
 * Vecino controller.
 *
 * @Route("/vecino")
 */
class VecinoController extends Controller
{
    /**
     * Lists all Vecino entities.
     *
     * @Route("/", name="vecino")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EdificioBundle:Vecino')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Vecino entity.
     *
     * @Route("/{id}/show", name="vecino_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EdificioBundle:Vecino')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vecino entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Vecino entity.
     *
     * @Route("/new", name="vecino_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vecino();
        $form   = $this->createForm(new VecinoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Vecino entity.
     *
     * @Route("/create", name="vecino_create")
     * @Method("POST")
     * @Template("EdificioBundle:Vecino:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Vecino();
        $form = $this->createForm(new VecinoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vecino_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vecino entity.
     *
     * @Route("/{id}/edit", name="vecino_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EdificioBundle:Vecino')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vecino entity.');
        }

        $editForm = $this->createForm(new VecinoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Vecino entity.
     *
     * @Route("/{id}/update", name="vecino_update")
     * @Method("POST")
     * @Template("EdificioBundle:Vecino:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EdificioBundle:Vecino')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vecino entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VecinoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vecino_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Vecino entity.
     *
     * @Route("/{id}/delete", name="vecino_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EdificioBundle:Vecino')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vecino entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vecino'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
