<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\TipoNorma;
use Fd\BackendBundle\Form\TipoNormaType;

/**
 * TipoNorma controller.
 *
 * @Route("/tiponorma")
 */
class TipoNormaController extends Controller
{
    /**
     * Lists all TipoNorma entities.
     *
     * @Route("/", name="backend_tiponorma")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:TipoNorma')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a TipoNorma entity.
     *
     * @Route("/{id}/show", name="backend_tiponorma_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:TipoNorma')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoNorma entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new TipoNorma entity.
     *
     * @Route("/new", name="backend_tiponorma_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoNorma();
        $form   = $this->createForm(new TipoNormaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new TipoNorma entity.
     *
     * @Route("/create", name="backend_tiponorma_create")
     * @Method("post")
     * @Template("TablaBundle:TipoNorma:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new TipoNorma();
        $request = $this->getRequest();
        $form    = $this->createForm(new TipoNormaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_tiponorma_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing TipoNorma entity.
     *
     * @Route("/{id}/edit", name="backend_tiponorma_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:TipoNorma')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoNorma entity.');
        }

        $editForm = $this->createForm(new TipoNormaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TipoNorma entity.
     *
     * @Route("/{id}/update", name="backend_tiponorma_update")
     * @Method("post")
     * @Template("TablaBundle:TipoNorma:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:TipoNorma')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoNorma entity.');
        }

        $editForm   = $this->createForm(new TipoNormaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_tiponorma_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TipoNorma entity.
     *
     * @Route("/{id}/delete", name="backend_tiponorma_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:TipoNorma')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoNorma entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_tiponorma'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
