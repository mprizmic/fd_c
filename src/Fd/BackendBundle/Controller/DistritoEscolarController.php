<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\DistritoEscolar;
use Fd\BackendBundle\Form\DistritoEscolarType;

/**
 * DistritoEscolar controller.
 *
 * @Route("/distrito_escolar")
 */
class DistritoEscolarController extends Controller
{
    /**
     * Lists all DistritoEscolar entities.
     *
     * @Route("/", name="backend_distrito_escolar")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:DistritoEscolar')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a DistritoEscolar entity.
     *
     * @Route("/{id}/show", name="backend_distrito_escolar_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:DistritoEscolar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DistritoEscolar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new DistritoEscolar entity.
     *
     * @Route("/new", name="backend_distrito_escolar_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DistritoEscolar();
        $form   = $this->createForm(new DistritoEscolarType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new DistritoEscolar entity.
     *
     * @Route("/create", name="backend_distrito_escolar_create")
     * @Method("post")
     * @Template("TablaBundle:DistritoEscolar:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new DistritoEscolar();
        $request = $this->getRequest();
        $form    = $this->createForm(new DistritoEscolarType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('distrito_escolar_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing DistritoEscolar entity.
     *
     * @Route("/{id}/edit", name="backend_distrito_escolar_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:DistritoEscolar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DistritoEscolar entity.');
        }

        $editForm = $this->createForm(new DistritoEscolarType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing DistritoEscolar entity.
     *
     * @Route("/{id}/update", name="backend_distrito_escolar_update")
     * @Method("post")
     * @Template("TablaBundle:DistritoEscolar:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:DistritoEscolar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DistritoEscolar entity.');
        }

        $editForm   = $this->createForm(new DistritoEscolarType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('distrito_escolar_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a DistritoEscolar entity.
     *
     * @Route("/{id}/delete", name="backend_distrito_escolar_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:DistritoEscolar')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DistritoEscolar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('distrito_escolar'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
