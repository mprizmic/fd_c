<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Comuna;
use Fd\BackendBundle\Form\ComunaType;

/**
 * Comuna controller.
 *
 * @Route("/comuna")
 */
class ComunaController extends Controller
{
    /**
     * Lists all Comuna entities.
     *
     * @Route("/", name="backend_comuna")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Comuna')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Comuna entity.
     *
     * @Route("/{id}/show", name="backend_comuna_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Comuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Comuna entity.
     *
     * @Route("/new", name="backend_comuna_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Comuna();
        $form   = $this->createForm(new ComunaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Comuna entity.
     *
     * @Route("/create", name="backend_comuna_create")
     * @Method("post")
     * @Template("TablaBundle:Comuna:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Comuna();
        $request = $this->getRequest();
        $form    = $this->createForm(new ComunaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comuna_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Comuna entity.
     *
     * @Route("/{id}/edit", name="backend_comuna_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Comuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comuna entity.');
        }

        $editForm = $this->createForm(new ComunaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Comuna entity.
     *
     * @Route("/{id}/update", name="backend_comuna_update")
     * @Method("post")
     * @Template("TablaBundle:Comuna:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Comuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Comuna entity.');
        }

        $editForm   = $this->createForm(new ComunaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('comuna_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Comuna entity.
     *
     * @Route("/{id}/delete", name="backend_comuna_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Comuna')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Comuna entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('comuna'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
