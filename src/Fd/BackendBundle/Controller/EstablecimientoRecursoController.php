<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso;
use Fd\BackendBundle\Form\EstablecimientoRecursoType;

/**
 * @Route("/establecimiento_recurso")
 */
class EstablecimientoRecursoController extends Controller
{
    /**
     * Lists all EstablecimientoRecurso entities.
     *
     * @Route("/", name="establecimiento_recurso")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EstablecimientoBundle:EstablecimientoRecurso')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a EstablecimientoRecurso entity.
     *
     * @Route("/{id}/show", name="establecimiento_recurso_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EstablecimientoBundle:EstablecimientoRecurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstablecimientoRecurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new EstablecimientoRecurso entity.
     *
     * @Route("/new", name="establecimiento_recurso_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EstablecimientoRecurso();
        $form   = $this->createForm(new EstablecimientoRecursoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new EstablecimientoRecurso entity.
     *
     * @Route("/create", name="establecimiento_recurso_create")
     * @Method("POST")
     * @Template("EstablecimientoBundle:EstablecimientoRecurso:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new EstablecimientoRecurso();
        $form = $this->createForm(new EstablecimientoRecursoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('establecimiento_recurso_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EstablecimientoRecurso entity.
     *
     * @Route("/{id}/edit", name="establecimiento_recurso_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EstablecimientoBundle:EstablecimientoRecurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstablecimientoRecurso entity.');
        }

        $editForm = $this->createForm(new EstablecimientoRecursoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EstablecimientoRecurso entity.
     *
     * @Route("/{id}/update", name="establecimiento_recurso_update")
     * @Method("POST")
     * @Template("EstablecimientoBundle:EstablecimientoRecurso:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EstablecimientoBundle:EstablecimientoRecurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstablecimientoRecurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EstablecimientoRecursoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('establecimiento_recurso_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EstablecimientoRecurso entity.
     *
     * @Route("/{id}/delete", name="establecimiento_recurso_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EstablecimientoBundle:EstablecimientoRecurso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EstablecimientoRecurso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('establecimiento_recurso'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
