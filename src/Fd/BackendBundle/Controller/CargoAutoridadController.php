<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\CargoAutoridad;
use Fd\BackendBundle\Form\CargoAutoridadType;

/**
 * CargoAutoridad controller.
 *
 * @Route("/cargo_autoridad")
 */
class CargoAutoridadController extends Controller
{
    /**
     * Lists all CargoAutoridad entities.
     *
     * @Route("/", name="backend_cargo_autoridad")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:CargoAutoridad')->findAllOrdenado('nombre');

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a CargoAutoridad entity.
     *
     * @Route("/{id}/show", name="backend_cargo_autoridad_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:CargoAutoridad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CargoAutoridad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new CargoAutoridad entity.
     *
     * @Route("/new", name="backend_cargo_autoridad_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CargoAutoridad();
        $form   = $this->createForm(new CargoAutoridadType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new CargoAutoridad entity.
     *
     * @Route("/create", name="backend_cargo_autoridad_create")
     * @Method("post")
     * @Template("TablaBundle:CargoAutoridad:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new CargoAutoridad();
        $request = $this->getRequest();
        $form    = $this->createForm(new CargoAutoridadType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');            

            return $this->redirect($this->generateUrl('backend_cargo_autoridad_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing CargoAutoridad entity.
     *
     * @Route("/{id}/edit", name="backend_cargo_autoridad_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:CargoAutoridad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CargoAutoridad entity.');
        }

        $editForm = $this->createForm(new CargoAutoridadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing CargoAutoridad entity.
     *
     * @Route("/{id}/update", name="backend_cargo_autoridad_update")
     * @Method("post")
     * @Template("TablaBundle:CargoAutoridad:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:CargoAutoridad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CargoAutoridad entity.');
        }

        $editForm   = $this->createForm(new CargoAutoridadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');            

            return $this->redirect($this->generateUrl('backend_cargo_autoridad_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a CargoAutoridad entity.
     *
     * @Route("/{id}/delete", name="backend_cargo_autoridad_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:CargoAutoridad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CargoAutoridad entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');            
        }

        return $this->redirect($this->generateUrl('backend_cargo_autoridad'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
