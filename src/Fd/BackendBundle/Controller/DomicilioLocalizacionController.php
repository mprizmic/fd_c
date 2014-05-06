<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;
use Fd\BackendBundle\Form\DomicilioLocalizacionType;

/**
 * DomicilioLocalizacion controller.
 *
 * @Route("/domicilio_localizacion")
 */
class DomicilioLocalizacionController extends Controller
{
    /**
     * Lists all DomicilioLocalizacion entities.
     *
     * @Route("/", name="backend_domicilio_localizacion")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EdificioBundle:DomicilioLocalizacion')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a DomicilioLocalizacion entity.
     *
     * @Route("/{id}/show", name="backend_domicilio_localizacion_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:DomicilioLocalizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DomicilioLocalizacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new DomicilioLocalizacion entity.
     *
     * @Route("/new", name="backend_domicilio_localizacion_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DomicilioLocalizacion();
        $form   = $this->createForm(new DomicilioLocalizacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new DomicilioLocalizacion entity.
     *
     * @Route("/create", name="backend_domicilio_localizacion_create")
     * @Method("post")
     * @Template("EdificioBundle:DomicilioLocalizacion:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new DomicilioLocalizacion();
        $request = $this->getRequest();
        $form    = $this->createForm(new DomicilioLocalizacionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_domicilio_localizacion_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing DomicilioLocalizacion entity.
     *
     * @Route("/{id}/edit", name="backend_domicilio_localizacion_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:DomicilioLocalizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DomicilioLocalizacion entity.');
        }

        $editForm = $this->createForm(new DomicilioLocalizacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing DomicilioLocalizacion entity.
     *
     * @Route("/{id}/update", name="backend_domicilio_localizacion_update")
     * @Method("post")
     * @Template("EdificioBundle:DomicilioLocalizacion:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EdificioBundle:DomicilioLocalizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DomicilioLocalizacion entity.');
        }

        $editForm   = $this->createForm(new DomicilioLocalizacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_domicilio_localizacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a DomicilioLocalizacion entity.
     *
     * @Route("/{id}/delete", name="backend_domicilio_localizacion_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EdificioBundle:DomicilioLocalizacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DomicilioLocalizacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_domicilio_localizacion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
