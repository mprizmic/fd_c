<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\TipoEstablecimiento;
use Fd\BackendBundle\Form\TipoEstablecimientoType;

/**
 * TipoEstablecimiento controller.
 *
 * @Route("/tipo_establecimiento")
 */
class TipoEstablecimientoController extends Controller
{
    /**
     * Lists all TipoEstablecimiento entities.
     *
     * @Route("/", name="backend_tipo_establecimiento")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:TipoEstablecimiento')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a TipoEstablecimiento entity.
     *
     * @Route("/{id}/show", name="backend_tipo_establecimiento_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:TipoEstablecimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEstablecimiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new TipoEstablecimiento entity.
     *
     * @Route("/new", name="backend_tipo_establecimiento_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoEstablecimiento();
        $form   = $this->createForm(new TipoEstablecimientoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new TipoEstablecimiento entity.
     *
     * @Route("/create", name="backend_tipo_establecimiento_create")
     * @Method("post")
     * @Template("TablaBundle:TipoEstablecimiento:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new TipoEstablecimiento();
        $request = $this->getRequest();
        $form    = $this->createForm(new TipoEstablecimientoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_tipo_establecimiento_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing TipoEstablecimiento entity.
     *
     * @Route("/{id}/edit", name="backend_tipo_establecimiento_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:TipoEstablecimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEstablecimiento entity.');
        }

        $editForm = $this->createForm(new TipoEstablecimientoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TipoEstablecimiento entity.
     *
     * @Route("/{id}/update", name="backend_tipo_establecimiento_update")
     * @Method("post")
     * @Template("TablaBundle:TipoEstablecimiento:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:TipoEstablecimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEstablecimiento entity.');
        }

        $editForm   = $this->createForm(new TipoEstablecimientoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_tipo_establecimiento_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TipoEstablecimiento entity.
     *
     * @Route("/{id}/delete", name="backend_tipo_establecimiento_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:TipoEstablecimiento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoEstablecimiento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_tipo_establecimiento'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
