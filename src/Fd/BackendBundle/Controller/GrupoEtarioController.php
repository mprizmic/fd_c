<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\GrupoEtario;
use Fd\BackendBundle\Form\GrupoEtarioType;

/**
 * GrupoEtario controller.
 *
 * @Route("/grupoetario")
 */
class GrupoEtarioController extends Controller {

    /**
     * Lists all GrupoEtario entities.
     *
     * @Route("/", name="backend.grupo_etario")
     * @Template("BackendBundle:GrupoEtario:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:GrupoEtario')->findBy(array(), array('orden' => 'ASC'));

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a GrupoEtario entity.
     *
     * @Route("/{id}/show", name="backend.grupo_etario.show")
     * @Template("BackendBundle:GrupoEtario:show.html.twig")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:GrupoEtario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEtario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new GrupoEtario entity.
     *
     * @Route("/new", name="backend.grupo_etario.new")
     * @Template("BackendBundle:GrupoEtario:new.html.twig")
     */
    public function newAction() {
        $entity = new GrupoEtario();
        $form = $this->createForm(new GrupoEtarioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new GrupoEtario entity.
     *
     * @Route("/create", name="backend.grupo_etario.create")
     * @Method("post")
     * @Template("BackendBundle:GrupoEtario:new.html.twig")
     */
    public function createAction() {
        $entity = new GrupoEtario();
        $request = $this->getRequest();
        $form = $this->createForm(new GrupoEtarioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend.grupo_etario.show', array('id' => $entity->getId())));
        }
        $this->get('session')->getFlashBag()->add('error', 'No se pudo guardar. Verifique y reintente.');

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing GrupoEtario entity.
     *
     * @Route("/{id}/edit", name="backend.grupo_etario.edit")
     * @Template("BackendBundle:GrupoEtario:edit.html.twig")
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:GrupoEtario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEtario entity.');
        }

        $editForm = $this->createForm(new GrupoEtarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing GrupoEtario entity.
     *
     * @Route("/{id}/update", name="backend.grupo_etario.update")
     * @Method("post")
     * @Template("BackendBundle:GrupoEtario:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:GrupoEtario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GrupoEtario entity.');
        }

        $editForm = $this->createForm(new GrupoEtarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend.grupo_etario.edit', array('id' => $id)));
        }
        $this->get('session')->getFlashBag()->add('error', 'No se pudo guardar. Verifique y reintente.');

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a GrupoEtario entity.
     *
     * @Route("/{id}/delete", name="backend.grupo_etario.delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:GrupoEtario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GrupoEtario entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', 'Guardado exitosamente');
        }
        $this->get('session')->getFlashBag()->add('error', 'No se pudo guardar. Verifique y reintente.');

        return $this->redirect($this->generateUrl('backend.grupo_etario'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
