<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\OfertaEducativaBundle\Entity\Titulo;
use Fd\OfertaEducativaBundle\Entity\TituloEstadoValidez;
use Fd\BackendBundle\Form\TituloEstadoValidezType;

/**
 *
 * @Route("/tituloestadovalidez")
 */
class TituloEstadoValidezController extends Controller
{
    /**
     * Lists all tituloEstadoValidez entities.
     *
     * @Route("/", name="backend_tituloestadovalidez")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OfertaEducativaBundle:TituloEstadoValidez')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a tituloEstadoValidez entity.
     *
     * @Route("/{id}/show", name="backend_tituloestadovalidez_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:TituloEstadoValidez')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TituloEstadoValidez entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new TituloEstadoValidez entity.
     *
     * @Route("/new", name="backend_tituloestadovalidez_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TituloEstadoValidez();
        $form   = $this->createForm(new TituloEstadoValidezType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new TituloEstadoValidez entity.
     *
     * @Route("/create", name="backend_tituloestadovalidez_create")
     * @Method("post")
     * @Template("OfertaEducativaBundle:TituloEstadoValidez:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new TituloEstadoValidez();
        $request = $this->getRequest();
        $form    = $this->createForm(new TituloEstadoValidezType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_tituloestadovalidez_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing TituloEstadoValidez entity.
     *
     * @Route("/{id}/edit", name="backend_tituloestadovalidez_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:TituloEstadoValidez')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TituloEstadoValidez entity.');
        }

        $editForm = $this->createForm(new TituloEstadoValidezType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TituloEstadoValidez entity.
     *
     * @Route("/{id}/update", name="backend_tituloestadovalidez_update")
     * @Method("post")
     * @Template("OfertaEducativaBundle:TituloEstadoValidez:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:TituloEstadoValidez')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TituloEstadoValidez entity.');
        }

        $editForm   = $this->createForm(new TituloEstadoValidezType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
            
            return $this->redirect($this->generateUrl('backend_tituloestadovalidez_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TituloEstadoValidez entity.
     *
     * @Route("/{id}/delete", name="backend_tituloestadovalidez_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OfertaEducativaBundle:TituloEstadoValidez')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TituloEstadoValidez entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
        }

        return $this->redirect($this->generateUrl('backend_tituloestadovalidez'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
