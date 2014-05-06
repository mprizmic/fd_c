<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Turno;
use Fd\BackendBundle\Form\TurnoType;

/**
 * Turno controller.
 *
 * @Route("/turno")
 */
class TurnoController extends Controller
{
    /**
     * Lists all Turno entities.
     *
     * @Route("/", name="backend_turno")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Turno')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Turno entity.
     *
     * @Route("/{id}/show", name="backend_turno_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Turno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Turno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Turno entity.
     *
     * @Route("/new", name="backend_turno_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Turno();
        $form   = $this->createForm(new TurnoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Turno entity.
     *
     * @Route("/create", name="backend_turno_create")
     * @Method("post")
     * @Template("TablaBundle:Turno:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Turno();
        $request = $this->getRequest();
        $form    = $this->createForm(new TurnoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_turno_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Turno entity.
     *
     * @Route("/{id}/edit", name="backend_turno_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Turno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Turno entity.');
        }

        $editForm = $this->createForm(new TurnoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Turno entity.
     *
     * @Route("/{id}/update", name="backend_turno_update")
     * @Method("post")
     * @Template("TablaBundle:Turno:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Turno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Turno entity.');
        }

        $editForm   = $this->createForm(new TurnoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_turno_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Turno entity.
     *
     * @Route("/{id}/delete", name="backend_turno_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Turno')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Turno entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_turno'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
