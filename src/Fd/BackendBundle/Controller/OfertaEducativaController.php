<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\BackendBundle\Form\OfertaEducativaType;

/**
 * OfertaEducativa controller.
 *
 * @Route("/ofertaeducativa")
 */
class OfertaEducativaController extends Controller
{
    /**
     * Lists all OfertaEducativa entities.
     *
     * @Route("/", name="backend_ofertaeducativa")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a OfertaEducativa entity.
     *
     * @Route("/{id}/show", name="backend_ofertaeducativa_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OfertaEducativa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new OfertaEducativa entity.
     *
     * @Route("/new", name="backend_ofertaeducativa_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new OfertaEducativa();
        $form   = $this->createForm(new OfertaEducativaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new OfertaEducativa entity.
     *
     * @Route("/create", name="backend_ofertaeducativa_create")
     * @Method("post")
     * @Template("OfertaEducativaBundle:OfertaEducativa:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new OfertaEducativa();
        $request = $this->getRequest();
        $form    = $this->createForm(new OfertaEducativaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_ofertaeducativa_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing OfertaEducativa entity.
     *
     * @Route("/{id}/edit", name="backend_ofertaeducativa_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OfertaEducativa entity.');
        }

        $editForm = $this->createForm(new OfertaEducativaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing OfertaEducativa entity.
     *
     * @Route("/{id}/update", name="backend_ofertaeducativa_update")
     * @Method("post")
     * @Template("OfertaEducativaBundle:OfertaEducativa:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OfertaEducativa entity.');
        }

        $editForm   = $this->createForm(new OfertaEducativaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
            
            return $this->redirect($this->generateUrl('backend_ofertaeducativa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a OfertaEducativa entity.
     *
     * @Route("/{id}/delete", name="backend_ofertaeducativa_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OfertaEducativa entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
        }

        return $this->redirect($this->generateUrl('backend_ofertaeducativa'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
