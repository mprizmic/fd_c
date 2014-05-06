<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Cgp;
use Fd\BackendBundle\Form\CgpType;

/**
 * Cgp controller.
 *
 * @Route("/cgp")
 */
class CgpController extends Controller
{
    /**
     * Lists all Cgp entities.
     *
     * @Route("/", name="backend_cgp")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Cgp')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Cgp entity.
     *
     * @Route("/{id}/show", name="backend_cgp_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Cgp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cgp entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Cgp entity.
     *
     * @Route("/new", name="backend_cgp_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cgp();
        $form   = $this->createForm(new CgpType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Cgp entity.
     *
     * @Route("/create", name="backend_cgp_create")
     * @Method("post")
     * @Template("TablaBundle:Cgp:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Cgp();
        $request = $this->getRequest();
        $form    = $this->createForm(new CgpType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cgp_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Cgp entity.
     *
     * @Route("/{id}/edit", name="backend_cgp_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Cgp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cgp entity.');
        }

        $editForm = $this->createForm(new CgpType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Cgp entity.
     *
     * @Route("/{id}/update", name="backend_cgp_update")
     * @Method("post")
     * @Template("BackendBundle:Cgp:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Cgp')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cgp entity.');
        }

        $editForm   = $this->createForm(new CgpType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_cgp_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Cgp entity.
     *
     * @Route("/{id}/delete", name="backend_cgp_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Cgp')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cgp entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cgp'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
