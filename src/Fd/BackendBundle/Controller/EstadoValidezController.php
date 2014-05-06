<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\EstadoValidez;
use Fd\BackendBundle\Form\EstadoValidezType;

/**
 * EstadoValidez controller.
 *
 * @Route("/estadovalidez")
 */
class EstadoValidezController extends Controller
{
    /**
     * Lists all EstadoValidez entities.
     *
     * @Route("/", name="backend_estadovalidez")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:EstadoValidez')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a EstadoValidez entity.
     *
     * @Route("/{id}/show", name="backend_estadovalidez_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:EstadoValidez')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoValidez entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new EstadoValidez entity.
     *
     * @Route("/new", name="backend_estadovalidez_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EstadoValidez();
        $form   = $this->createForm(new EstadoValidezType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new EstadoValidez entity.
     *
     * @Route("/create", name="backend_estadovalidez_create")
     * @Method("post")
     * @Template("TablaBundle:EstadoValidez:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new EstadoValidez();
        $request = $this->getRequest();
        $form    = $this->createForm(new EstadoValidezType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_estadovalidez_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing EstadoValidez entity.
     *
     * @Route("/{id}/edit", name="backend_estadovalidez_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:EstadoValidez')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoValidez entity.');
        }

        $editForm = $this->createForm(new EstadoValidezType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EstadoValidez entity.
     *
     * @Route("/{id}/update", name="backend_estadovalidez_update")
     * @Method("post")
     * @Template("TablaBundle:EstadoValidez:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:EstadoValidez')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoValidez entity.');
        }

        $editForm   = $this->createForm(new EstadoValidezType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
            
            return $this->redirect($this->generateUrl('backend_estadovalidez_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EstadoValidez entity.
     *
     * @Route("/{id}/delete", name="backend_estadovalidez_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:EstadoValidez')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EstadoValidez entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
        }

        return $this->redirect($this->generateUrl('backend_estadovalidez'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
