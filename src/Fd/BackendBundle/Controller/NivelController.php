<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Nivel;
use Fd\BackendBundle\Form\NivelType;

/**
 * Nivel controller.
 *
 * @Route("/nivel")
 */
class NivelController extends Controller
{
    /**
     * Lists all Nivel entities.
     *
     * @Route("/", name="backend_nivel")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Nivel')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Nivel entity.
     *
     * @Route("/{id}/show", name="backend_nivel_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Nivel entity.
     *
     * @Route("/new", name="backend_nivel_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Nivel();
        $form   = $this->createForm(new NivelType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Nivel entity.
     *
     * @Route("/create", name="backend_nivel_create")
     * @Method("post")
     * @Template("TablaBundle:Nivel:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Nivel();
        $request = $this->getRequest();
        $form    = $this->createForm(new NivelType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nivel_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Nivel entity.
     *
     * @Route("/{id}/edit", name="backend_nivel_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $editForm = $this->createForm(new NivelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Nivel entity.
     *
     * @Route("/{id}/update", name="backend_nivel_update")
     * @Method("post")
     * @Template("TablaBundle:Nivel:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $editForm   = $this->createForm(new NivelType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nivel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Nivel entity.
     *
     * @Route("/{id}/delete", name="backend_nivel_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Nivel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nivel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nivel'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
