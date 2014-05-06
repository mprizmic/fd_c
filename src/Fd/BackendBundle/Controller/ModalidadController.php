<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Modalidad;
use Fd\BackendBundle\Form\ModalidadType;

/**
 * Modalidad controller.
 *
 * @Route("/modalidad")
 */
class ModalidadController extends Controller
{
    /**
     * Lists all Modalidad entities.
     *
     * @Route("/", name="backend_modalidad")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Modalidad')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Modalidad entity.
     *
     * @Route("/{id}/show", name="backend_modalidad_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Modalidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modalidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Modalidad entity.
     *
     * @Route("/new", name="backend_modalidad_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Modalidad();
        $form   = $this->createForm(new ModalidadType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Modalidad entity.
     *
     * @Route("/create", name="backend_modalidad_create")
     * @Method("post")
     * @Template("TablaBundle:Modalidad:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Modalidad();
        $request = $this->getRequest();
        $form    = $this->createForm(new ModalidadType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modalidad_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Modalidad entity.
     *
     * @Route("/{id}/edit", name="backend_modalidad_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Modalidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modalidad entity.');
        }

        $editForm = $this->createForm(new ModalidadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Modalidad entity.
     *
     * @Route("/{id}/update", name="backend_modalidad_update")
     * @Method("post")
     * @Template("TablaBundle:Modalidad:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Modalidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modalidad entity.');
        }

        $editForm   = $this->createForm(new ModalidadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modalidad_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Modalidad entity.
     *
     * @Route("/{id}/delete", name="backend_modalidad_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Modalidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Modalidad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('modalidad'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
