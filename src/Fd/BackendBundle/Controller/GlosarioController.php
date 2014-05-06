<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Glosario;
use Fd\BackendBundle\Form\GlosarioType;

/**
 * Glosario controller.
 *
 * @Route("/glosario")
 */
class GlosarioController extends Controller
{
    /**
     * Lists all Glosario entities.
     *
     * @Route("/", name="backend_glosario")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Glosario')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Glosario entity.
     *
     * @Route("/{id}/show", name="backend_glosario_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Glosario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Glosario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Glosario entity.
     *
     * @Route("/new", name="backend_glosario_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Glosario();
        $form   = $this->createForm(new GlosarioType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Glosario entity.
     *
     * @Route("/create", name="backend_glosario_create")
     * @Method("post")
     * @Template("TablaBundle:Glosario:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Glosario();
        $request = $this->getRequest();
        $form    = $this->createForm(new GlosarioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_glosario_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Glosario entity.
     *
     * @Route("/{id}/edit", name="backend_glosario_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Glosario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Glosario entity.');
        }

        $editForm = $this->createForm(new GlosarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Glosario entity.
     *
     * @Route("/{id}/update", name="backend_glosario_update")
     * @Method("post")
     * @Template("TablaBundle:Glosario:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Glosario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Glosario entity.');
        }

        $editForm   = $this->createForm(new GlosarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
            
            return $this->redirect($this->generateUrl('backend_glosario_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Glosario entity.
     *
     * @Route("/{id}/delete", name="backend_glosario_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Glosario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Glosario entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
        }

        return $this->redirect($this->generateUrl('backend_glosario'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
